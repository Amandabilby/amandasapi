<?php 

class Cart {
    private $database_handler;
    private $cart_validity_time = 2; // in days.


    public function __construct($database_handler_IN)
    {
        $this->database_handler = $database_handler_IN;
    }





    public function addToCart($userId_IN, $productsId_IN)
    {


        // check if product exist
        if ($this->getProduct($productsId_IN) !== false) {
            // Product exists!

            // get cart. (Will create a new one if it doesn't exist).
            $cart = $this->getCart($userId_IN);


            $query_string = "INSERT INTO cart(id, products_id) VALUES (:cartId , :productsId_IN)";
            $statementHandler = $this->database_handler->prepare($query_string);

            if ($statementHandler !== false) {

                $cartId = $cart['Id'];

                $statementHandler->bindParam(":cartId", $cartId);
                $statementHandler->bindParam(":productsId_IN", $productsId_IN);

                $execSuccess = $statementHandler->execute();

                if ($execSuccess === true) {
                    // Product successfully to cart.
                    // Return message
                    return "Product added to cart";
                } else {
                    $errorMessage = "Execute failed.";
                    $errorLocation = "addToCart() in Carts.php";
                }
            } else {
                $errorMessage = "Statementhandler failed.";
                $errorLocation = "addToCart() in Carts.php";
            }

            return $this->errorHandler($errorMessage, $errorLocation);
        } else {
            $errorMessage = "Product doesn't exist!";
            $errorLocation = "addToCart() in Carts.php";
            return $this->errorHandler($errorMessage, $errorLocation);
        }
    }

    public function getProduct($id_IN)
    {
        /*
        
        Column = which column to match with value
        Value  = which value match with column
        
        Example:
        getProduct(Color, "Yellow") will return a product with color yellow. 
        
        Return FALSE if there's no match in DB
        
        */

        $query_string = "SELECT Id, title, price, date_posted FROM products WHERE Id = :id_IN ";


        $statementHandler = $this->database_handler->prepare($query_string);

        if ($statementHandler !== false) {

            $statementHandler->bindParam(":id_IN", $id_IN);

            $execSuccess = $statementHandler->execute();

            if ($execSuccess === true) {
                // fetch result
                $result = $statementHandler->fetch(PDO::FETCH_ASSOC);

                if (!empty($result)) {
                    // return Product
                    return $result;
                } else {
                    // No match in DB
                    return false;
                }
            } else {
                $errorMessage = "Execute Failed";
                $errorLocation = "getProduct() in Products.php";
            }
        } else {
            $errorMessage = "StatementHandler Failed";
            $errorLocation = "getProduct() in Products.php";
        }
        return $this->errorHandler($errorMessage, $errorLocation);
    }

    public function getCart($userId_IN)
    {
        // If cart doesn't exist , create cart
        if ($this->checkCart($userId_IN) === false) {
            // create cart
            // echo "create cart";
            $this->createCart($userId_IN);
            // Run this method again to get cart
            return $this->getCart($userId_IN);
        } else {
            // Cart exists
            // echo "cart exist";
            return $this->checkCart($userId_IN);
        }
    }


    

private function createCart($userId_IN)
{
    $query_string = "INSERT INTO cart(user_id) VALUES (:userId_IN)";

    $statementHandler = $this->database_handler->prepare($query_string);

    if ($statementHandler !== false) {

        $statementHandler->bindParam(":userId_IN", $userId_IN);
        $execSuccess = $statementHandler->execute();

        if ($execSuccess === true) {
            // Cart created, return cart_id
            return true;
        } else {
            $errorMessage = "Execute failed.";
            $errorLocation = "createCart() in Carts.php";
        }
    } else {
        $errorMessage = "Statementhandler failed.";
        $errorLocation = "createCart() in Carts.php";
    }

    return $this->errorHandler($errorMessage, $errorLocation);
}

private function errorHandler($message_IN, $errorLocation_IN = 0)
{
    $returnObject = new stdClass;
    $returnObject->message = $message_IN;

    if ($errorLocation_IN !== 0) {
        $returnObject->location = $errorLocation_IN;
    }
    echo json_encode($returnObject);
}

public function checkCart($userId_IN)
{
    /* 
    If cart:
    exists          ->   checkCart() returns cart
    doesn't exist   ->   checkCart() returns FALSE
    */

    $query_string = "SELECT Id, user_id FROM cart WHERE user_id = :userId_IN";

    $statementHandler = $this->database_handler->prepare($query_string);

    if ($statementHandler !== false) {

        $statementHandler->bindParam("userId_IN", $userId_IN);

        $execSuccess = $statementHandler->execute();

        if ($execSuccess === true) {

            $result = $statementHandler->fetch(PDO::FETCH_ASSOC);

            if (!empty($result)) {
                // Cart exists
                // check if last updated < 2 days

                if ($this->validateCart($result['Id']) !== false) {
                    // Cart is valid, return cart
                    return $result;
                } else {
                    // Cart isnt valid delete cart
                    if ($this->deleteCart($result['Id']) === true) {
                        // echo "Cart session expired, cart is deleted.";
                        return false;
                    }
                }
            } else {
                // Cart doesn't exist
                return false;
            }
        } else {
            $errorMessage = "Execute() failed";
            $errorLocation = "checkCart() in Carts.php";
        }
    } else {
        $errorMessage = "Statementhandler failed";
        $errorLocation = "checkCart() in Carts.php";
    }

    return $this->errorHandler($errorMessage, $errorLocation);
}


}