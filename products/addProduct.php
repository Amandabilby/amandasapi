<?php
include("../object/products.php");
include('../object/users.php');


$posts_object = new Product($databaseHandler);
$user_handler = new User($databaseHandler);


$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}

$isAdmin = $user_handler->isAdmin($token);

if($isAdmin === false) {
    echo "You are not admin";
    die;
}





$title_IN = ( isset($_POST['title']) ? $_POST['title'] : '' );
$price_IN = ( isset($_POST['price']) ? $_POST['price'] : '' );


if(!empty($title_IN)) {
    if(!empty($price_IN)) {

        $posts_object->addPost($title_IN, $price_IN);

    } else {
        echo "Error: content cannot be empty!";
    }
} else {
    echo "Error: titel cannot be empty!";
}



?>