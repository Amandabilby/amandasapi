<?php
include('../../object/users.php');
include("../../object/cart.php");

// Create handler.
$token_object = new Cart($databaseHandler);

// Gets all products in cart where the token is set.

$token = ( !empty($_GET['token'] ) ? $_GET['token'] : -1 );


if($token > -1) {

    $token_object->setCartIn($token);
    print_r( $token_object->fetchAllCarts() );


} else {

    echo "Error: Missing parameter id!";

}

?>