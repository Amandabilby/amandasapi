<?php

    include("../../object/users.php");

    // Create handlers.

    $user_handler = new User($databaseHandler);

    // Add new user to DB.

    echo $user_handler->addUser($_POST['username'], $_POST['password'], $_POST['email']);


?>