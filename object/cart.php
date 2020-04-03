<?php 

class Cart {
    private $database_handler;
    private $cart_validity_time = 2; // in days.


    public function __construct($database_handler_IN)
    {
        $this->database_handler = $database_handler_IN;
    }

    public function addToCart($productId_IN, $token_IN)
    {


    
            $query_string = "INSERT INTO cart(Products_Id, token) VALUES (:productId_IN, :token_IN)";
            $statementHandler = $this->database_handler->prepare($query_string);

            if ($statementHandler !== false) {

                $statementHandler->bindParam(":productId_IN", $productId_IN);
                $statementHandler->bindParam(":token_IN", $token_IN);


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

            echo "Can't add to cart, sorry.";
            // return $this->errorHandler($errorMessage, $errorLocation);
        } 

        /* public function fetchAllCarts() {

            $query_string = "SELECT id, products_id, token FROM cart WHERE token=:token_IN";
            $statementHandler = $this->database_handler->prepare($query_string);
    
            if($statementHandler !== false) {
    
                $statementHandler->bindParam(":token_IN", $token_IN);

                $statementHandler->execute();
                return $statementHandler->fetchAll();
    
            } else {
                echo "Could not create database statement!";
                die();
            }
            
        } */

        public function setCartIn($token_IN) {

            $this->token_IN = $token_IN;
    
        }

        public function fetchAllCarts() {

            $query_string = "SELECT id, products_id, token FROM cart WHERE token=:token_IN";
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
    }


