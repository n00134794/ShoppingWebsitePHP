<?php
require_once 'Product.php';
require_once 'Connection.php';
require_once 'ProductTableGateway.php';

$session_id = session_id();
if ($session_id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new ProductTableGateway($connection);

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$costPrice = $_POST['costPrice'];
$salePrice = $_POST['salePrice'];
$quantity= $_POST['quantity'];

$gateway->updateProduct($id, $name, $description, $costPrice, $salePrice, $quantity);

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';



header('Location: home.php');






