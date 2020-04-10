<?php
include("../../object/products.php");
include('../../object/users.php');


// Create handlers.
$posts_object = new Product($databaseHandler);
$user_handler = new User($databaseHandler);


$token = $_POST['token'];


if($user_handler->validateToken($token) === false) {
    $retObject = new stdClass;
    $retObject->error = "Token is invalid";
    $retObject->errorCode = 1338;
    echo json_encode($retObject);
    die();
}


$isAdmin = $user_handler->isAdmin($token); // Check if user is admin.

if($isAdmin === false) {
    echo "You are not admin"; // If user is not admin, messade that you can't add to card. 
    die;
}



// Adds product to database if no fields are empty & user is admin.

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