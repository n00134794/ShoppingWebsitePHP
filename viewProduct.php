<?php
require_once 'Product.php';
require_once 'Connection.php';
require_once 'ProductTableGateway.php';

$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';

if (!isset($_GET) || !isset($_GET['id'])) {
    die('Invalid request');
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new ProductTableGateway($connection);

$statement = $gateway->getProductById($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css.css" rel="stylesheet">
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/product.js"></script>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php 
        if (isset($message)) {
            echo '<p>'.$message.'</p>';
        }
        ?>
        <table border="1">
            <tbody>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cost Price</th>
                    <th>Sale Price</th>
                    <th>Quantity</th>
                </tr>
                <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                echo '<tr>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['description']. '</td>';
                echo '<td>' . $row['costPrice'] . '</td>';
                echo '<td>' . $row['salePrice'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '</tr>';
                ?>
            </tbody>
        </table>
        <p>
            <a href="editProductForm.php?id=<?php echo $row['id']; ?>">
                Edit Product</a>
            <a class="deleteProduct" href="deleteProduct.php?id=<?php echo $row['id']; ?>">
                Delete Product</a>
        </p>
    </body>
</html>
