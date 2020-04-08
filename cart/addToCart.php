<?php
include("../../object/cart.php");
include("../../object/users.php");

$cart_handler = new Cart($databaseHandler);
$user_handler = new User($databaseHandler);

$productid_IN = ( isset($_POST['Id']) ? $_POST['Id'] : '' );
$token_IN = ( isset($_POST['token']) ? $_POST['token'] : '' );





if(!empty($productid_IN)) {
    if(!empty($token_IN)) {


        $cart_handler->addToCart($productid_IN, $token_IN);

    } else {
        echo "Error: content cannot be empty!";
        }
    } else {
        echo "Token cant be empty";
    }

    $token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die; }