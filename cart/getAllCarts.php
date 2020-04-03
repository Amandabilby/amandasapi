<?php
/* include('../object/cart.php');
include('../object/users.php');

$posts_object = new Cart($databaseHandler);
$user_handler = new User($databaseHandler);


$token_IN = ( isset($_POST['token']) ? $_POST['token'] : '' );


if(!empty($token_IN)) {

echo "<pre>";
print_r($posts_object->fetchAllCarts());
echo "</pre>";

} 
else {
 echo "Token can't be empty";
}


$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}


*/

?>


<?php
include('../object/users.php');

include("../object/cart.php");
$token_object = new Cart($databaseHandler);

$token = ( !empty($_GET['token'] ) ? $_GET['token'] : -1 );


if($token > -1) {

    $token_object->setCartIn($token);
    print_r( $token_object->fetchAllCarts() );


} else {

    echo "Error: Missing parameter id!";

}

?>