<?php
require_once 'Product.php';
require_once 'Connection.php';
require_once 'ProductTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

$connection = Connection::getInstance();
$gateway = new ProductTableGateway($connection);

$name = $_POST['name'];
$description = $_POST['description'];
$costPrice = $_POST['costPrice'];
$salePrice = $_POST['salePrice'];
$quantity= $_POST['quantity'];

$id = $gateway->insertProduct($name, $description, $costPrice, $salePrice, $quantity);

header('Location: home.php');