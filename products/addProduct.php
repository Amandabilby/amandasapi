<?php
include("../object/products.php");
$posts_object = new Product($databaseHandler);

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