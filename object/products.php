<?php

include("../../config/database_handler.php");

class Product {
    private $database_handler;
    private $post_id;

    public function __construct( $database_handler_IN ) {

        $this->database_handler = $database_handler_IN;

    }

    public function setPostId($post_id_IN) {

        $this->post_id = $post_id_IN;

    }

    public function fetchSinglePost() {

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

    

    public function fetchAllPosts() {

        $order = "desc";

    if(isset($_POST['order']) && $_POST['order'] == "asc") {
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

    public function addPost($title_param, $price_param) {

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

    public function deletePost($data) {


        if(!empty($data['id'])) {
            $query_string = "DELETE FROM products WHERE id=post_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":post_id", $data['id']);

            $statementHandler->execute();
            
        }

        $query_string = "SELECT id, title, price, date_posted, user_id FROM products WHERE id=:post_id";
        $statementHandler = $this->database_handler->prepare($query_string);

        $statementHandler->bindParam(":post_id", $data['id']);
        $statementHandler->execute();

        echo json_encode($statementHandler->fetch());


    }

    public function updatePost($data) {


        if(!empty($data['title'])) {
            $query_string = "UPDATE products SET title=:title WHERE id=:post_id";
            $statementHandler = $this->database_handler->prepare($query_string);

            $statementHandler->bindParam(":title", $data['title']);
            $statementHandler->bindParam(":post_id", $data['id']);

            $statementHandler->execute();
            
        }

        if(!empty($data['content'])) {
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

}


?>