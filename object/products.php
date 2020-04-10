<?php

include("../../config/database_handler.php");

class Product {
    private $database_handler;
    private $post_id;
    private $token_validity_time = 20; // minutes


    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setPostId($post_id_IN) {

        $this->post_id = $post_id_IN;

    }

    public function fetchSinglePost() { // Gets one product from database

        $query_string = "SELECT id, title, price, date_posted, user_id FROM products WHERE id=:post_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {
            
            $statementHandler->bindParam(":post_id", $this->post_id);
            $statementHandler->execute();

            return $statementHandler->fetch();

        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    

    public function fetchAllPosts() { // Gets all products from database

        $order = "desc";

    if(isset($_POST['order']) && $_POST['order'] == "asc") { // Makes it able to choose order asc or desc
        $order ="asc";
    }

        $query_string = "SELECT id, title, price, date_posted, user_id FROM products ORDER BY price $order";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->execute();
            return $statementHandler->fetchAll();

        } else {
            echo "Could not create database statement!";
            die();
        }
        
    }

    public function addPost($title_param, $price_param) { // Add a new product

        $query_string = "INSERT INTO products (title, price, user_id) VALUES(:title_IN, :price_IN, 1)";
        $statementHandler = $this->database_handler->prepare($query_string);

        if($statementHandler !== false) {

            $statementHandler->bindParam(":title_IN", $title_param);
            $statementHandler->bindParam(":price_IN", $price_param);
            
            $success = $statementHandler->execute();

            if($success === true) {
                echo "OK!";
            } else {
                echo "Error while trying to insert post to database!";
            }

        } else {
            echo "Could not create database statement!";
            die();
        }
    }

    public function deleteProduct($data) { // Delete product
        

        if(!empty($data['product_id'])) {
            $query_string = "DELETE FROM products WHERE id=product_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            if($statementHandler !== false) {

            $statementHandler->bindParam(":product_id", $product_id);


            $statementHandler->execute();
            } else {
                echo "Could not create database statement";
                die();
            }
        }

    }

    
    public function updatePost($data) { // Update a product


        if(!empty($data['title'])) { // If title is changed
            $query_string = "UPDATE products SET title=:title WHERE id=:post_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":title", $data['title']);
            $statementHandler->bindParam(":post_id", $data['id']);

            $statementHandler->execute();
            
        }

        if(!empty($data['price'])) { // If price is changed
            $query_string = "UPDATE products SET price=:price WHERE id=:post_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":price", $data['price']);
            $statementHandler->bindParam(":post_id", $data['id']);

            $statementHandler->execute();
            
        }

        $query_string = "SELECT id, title, price, date_posted, user_id FROM products WHERE id=:post_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":post_id", $data['id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }

    public function validateToken($token) { // Validates token

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


?>