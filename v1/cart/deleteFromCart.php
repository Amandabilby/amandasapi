<?php
include("../../object/cart.php");

// Deletes product from DB in cart where token is.

//Create handler
$cart_handler = new Cart($databaseHandler);

$token = ( isset($_POST['token']) ? $_POST['token'] : '');
$products_id = ( isset($_POST['products_id']) ? $_POST['products_id'] : '');

$cart_handler->deleteProductFromCart($token, $products_id);
$cart_handler->validateToken($_POST['token']);

$token = $_POST['token'];



?>
