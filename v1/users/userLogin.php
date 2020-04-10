<?php

    include("../../object/users.php");

    // Create handlers.
    $user_handler = new User($databaseHandler);


    // Login user.

    print_r($user_handler->loginUser($_POST['username'], $_POST['password']));
    


?>