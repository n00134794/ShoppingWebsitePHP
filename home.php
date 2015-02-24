<?php
require_once 'Product.php'; 
require_once 'Connection.php';
require_once 'ProductTableGateway.php';
require 'ensureUserLoggedIn.php';
 


$connection = Connection::getInstance();
$gateway = new ProductTableGateway($connection);

$products = $gateway->getProducts();
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
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cost Price</th>
                    <th>Sale Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $row = $products->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['description']. '</td>';
                    echo '<td>' . $row['costPrice'] . '</td>';
                    echo '<td>' . $row['salePrice'] . '</td>';
                    echo '<td>' . $row['quantity'] . '</td>';
                    echo '<td>' .
                    '<a href="viewProduct.php?id='.$row['id'].'">View</a> ' .
                    '<a href="editProductForm.php?id='.$row['id'].'">Edit</a> ' .
                    '<a class="deleteProduct" href="deleteProduct.php?id='.$row['id'].'">Delete</a> ' .
                    '</td>';
                    echo '</tr>';
                    $row = $products->fetch(PDO::FETCH_ASSOC);
                }
                ?>
            </tbody>
        </table>
        <p><a href="createProductForm.php">Create Product</a></p>
    </body>
</html>
