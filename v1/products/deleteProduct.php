<?php
include('../../object/products.php');
include('../../object/users.php');

$post_handler = new Product($databaseHandler);
$user_handler = new User($databaseHandler);

if(!empty($_POST['token'])) {

    if(!empty($_POST['id'])) { 

        $token = $_POST['token'];

        if($user_handler->validateToken($token) === false) {
            $retObject = new stdClass;
            $retObject->error = "Token is invalid";
            $retObject->errorCode = 1338;
            echo json_encode($retObject);
            die();
        }

        $post_handler->deletePost($_POST);


    } else {
        $retObject = new stdClass;
        $retObject->error = "Invalid id!";
        $retObject->errorCode = 1336;

        echo json_encode($retObject);
    }

} else {
    $retObject = new stdClass;
    $retObject->error = "No token found!";
    $retObject->errorCode = 1337;

    echo json_encode($retObject);
}
