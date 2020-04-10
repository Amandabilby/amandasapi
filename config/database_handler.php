<?php

// Php settings
$host = "localhost";
$user = "root";
$pass = "";
$db = "amandasapi";

// Connection with database
try {
    $dsn = "mysql:host=$host;dbname=$db;";
    $databaseHandler = new PDO($dsn, $user, $pass);

} catch(PDOException $e) {
    // Error
    echo "Error! ". $e->getMessage() ."<br />";
    die;
}


?>