<?php
include("../../object/cart.php");
include('../../object/products.php');
include('../../object/users.php');

// Create handlers.
$post_handler = new Product($databaseHandler);
$user_handler = new User($databaseHandler);
$cart_handler = new Cart($databaseHandler);

// Checking out cart, change status in DB to 'checked out' if token is valid.

$token_IN = ( isset($_POST['token']) ? $_POST['token'] : '' );
$status_IN = ( isset($_POST['status']) ? $_POST['status'] : '' );

$token = $_POST['token'];

if($cart_handler->validateToken($token) === false) {
    echo "invalid token";
    die;
}

if(!empty($token_IN)) {
    if(!empty($status_IN)) {

        $cart_handler->orderCart($token_IN, $status_IN);

    } else {
        echo "Error: token cannout be empty";
    } 
    } else {
        echo "cant checkout";
    }


