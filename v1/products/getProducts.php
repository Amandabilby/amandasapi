<?php
include("../../object/products.php");

// Create handlers.
$posts_object = new Product($databaseHandler);

$postID = ( !empty($_GET['id'] ) ? $_GET['id'] : -1 );

// Get the product info of the product ID is typed in.

if($postID > -1) {

    $posts_object->setPostId($postID);
    print_r( $posts_object->fetchSinglePost() );


} else {

    echo "Error: Missing parameter id!";

}

?>
