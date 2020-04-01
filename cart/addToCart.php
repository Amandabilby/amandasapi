<?php
include("../object/cart.php");
include("../object/users.php");

$cart_handler = new Cart($databaseHandler);
$user_handler = new User($databaseHandler);




$token = isset($_POST['token']) ? $_POST['token'] : "";
$productId = isset($_POST['Id']) ? $_POST['Id'] : "";



// Init errors
$error = false;
$errorMessages = "";

// Check for empty values
if (empty($token)) {
    $error = true;
    $errorMessages = "token is empty! ";
}

if (empty($productId)) {
    $error = true;
    $errorMessages .= "Product Id is empty! ";
}

if ($error == true) {
    echo $errorMessages;
    die;
}



if ($user_handler->validateToken($token) !== false) {
    // Token is valid
        echo $cart_handler->addToCart($userId, $productId);
        return;
    }  


/*
if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}*/