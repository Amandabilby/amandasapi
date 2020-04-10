<?php 

include("../../config/database_handler.php");


class Cart {
    private $database_handler;
    private $cart_validity_time = 20; 


    public function __construct($database_handler_IN)
    {
        $this->database_handler = $database_handler_IN;
    }

    public function addToCart($productId_IN, $token_IN) // Insert the products in the cart-database
    {

        $query_string = "INSERT INTO cart(Products_Id, token) VALUES (:productId_IN, :token_IN)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if ($statementHandler !== false) {

            $statementHandler->bindParam(":productId_IN", $productId_IN);
            $statementHandler->bindParam(":token_IN", $token_IN);


            $execSuccess = $statementHandler->execute();

                if ($execSuccess === true) { // If product added to cart
                    return "Product added to cart";

                } else {
                
                    $errorMessage = "Statementhandler failed";
                    $errorLocation = "addToCart";
                }
            } else {
                $errorMessage = "Statementhandler failed.";
                $errorLocation = "addToCart";
            }

            echo "Not able to add to cart";
        } 

       
        public function setCartIn($token_IN) {

            $this->token_IN = $token_IN;
    
        }

        public function fetchAllCarts() { // function to get all products in cart

            $order = "desc";

            if(isset($_GET['order']) && $_GET['order'] == "asc") {
                $order ="asc";
            } // Makes it able to choose desc or asc order

            $query_string = "SELECT id, products_id, token, status FROM cart WHERE token=:token_IN ORDER BY id $order";
            $statementHandler = $this->database_handler->prepare($query_string);
    
            if($statementHandler !== false) {
                
                $statementHandler->bindParam(":token_IN", $this->token_IN);
                $statementHandler->execute();
    
                return $statementHandler->fetchAll();
    
            } else {
                echo "Could not create database statement!";
                die();
            }
        }

        public function orderCart($token, $status) { // Sets order status in cart (as checkedout)

            $query_string = "UPDATE cart SET status=:status WHERE token=:token";
            $statementHandler = $this->database_handler->prepare($query_string);

            if($statementHandler !== false) {

            $statementHandler->bindParam(":status", $status);
            $statementHandler->bindParam(':token', $token);

            $statementHandler->execute();

            } else {
            echo "Could not create database statement!";
            die();
        }

           
    }

    public function deleteProductFromCart($token, $products_id) { // Delete product from cart (with chosen product id)
        $query_string = "DELETE FROM carts WHERE token=:token AND products_id=:products_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":token", $token);
            $statementHandler->bindParam(":products_id", $product_id);

            $statementHandler->execute();

        } else {
            echo "Could not create database statement";
        }
        }
    
    
        public function validateToken($token) { // Validate token

            $query_string = "SELECT user_id, date_updated FROM tokens WHERE token=:token";
            $statementHandler = $this->database_handler->prepare($query_string);
    
            if($statementHandler !== false ){
    
                $statementHandler->bindParam(":token", $token);
                $statementHandler->execute();
    
                $token_data = $statementHandler->fetch();
    
                if(!empty($token_data['date_updated'])) {
    
                    $diff = time() - $token_data['date_updated'];
    
                    if( ($diff / 60) < $this->token_validity_time ) {
    
                        $query_string = "UPDATE tokens SET date_updated=:updated_date WHERE token=:token";
                        $statementHandler = $this->database_handler->prepare($query_string);
                        
                        $updatedDate = time();
                        $statementHandler->bindParam(":updated_date", $updatedDate, PDO::PARAM_INT);
                        $statementHandler->bindParam(":token", $token);
    
                        $statementHandler->execute();
    
                        return true;
    
                    } else {
                        echo "Session closed due to inactivity<br />";
                        return false;
                    }
                } else {
                    echo "Could not find token, please login first<br />";
                    return false;
                }
    
            } else {
                echo "Couldnt create statementhandler<br />";
                return false;
            }

    }
    
}
