<?php
include('../../object/products.php');
include('../../object/users.php');

// Create handler.
$product_handler = new Product($databaseHandler);

$token = ( isset($_POST['token']) ? $_POST['token'] : '' );


$product_id = ( isset($_POST['product_id']) ? $_POST['product_id'] : '' );



$product_handler->deleteProduct($token, $product_id);
$product_handler->validateToken($_POST['token']);

?>