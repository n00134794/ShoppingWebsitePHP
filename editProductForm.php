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
if ($statement->rowCount() !== 1) {
    die("Illegal request");
}
$row = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title></title> 
        <script type="text/javascript" src="js/product.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <h1>Edit Product Form</h1>
        <?php
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="editProductForm" name="editProductForm" action="editProduct.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <table border="1">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="<?php
                                if (isset($_POST) && isset($_POST['name'])) {
                                    echo $_POST['name'];
                                }
                                else echo $row['name'];
                            ?>" />
                            <span id="nameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['name'])) {
                                    echo $errorMessage['name'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="description" value="<?php
                                if (isset($_POST) && isset($_POST['email'])) {
                                    echo $_POST['description'];
                                }
                                else echo $row['description'];
                            ?>" />
                            <span id="descriptionError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['description'])) {
                                    echo $errorMessage['description'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Cost Price</td>
                        <td>
                            <input type="text" name="costPrice" value="<?php
                                if (isset($_POST) && isset($_POST['costPrice'])) {
                                    echo $_POST['costPrice'];
                                }
                                else echo $row['costPrice'];
                            ?>" />
                            <span id="costPriceError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['costPrice'])) {
                                    echo $errorMessage['costPrice'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sale Price</td>
                        <td>
                            <input type="text" name="salePrice" value="<?php
                                if (isset($_POST) && isset($_POST['salePrice'])) {
                                    echo $_POST['salePrice'];
                                }
                                else echo $row['salePrice'];
                            ?>" />
                            <span id="salePriceError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['salePrice'])) {
                                    echo $errorMessage['salePrice'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>
                            <input type="quantity" name="quantity" value="<?php
                                if (isset($_POST) && isset($_POST['quantity'])) {
                                    echo $_POST['quantity'];
                                }
                                else echo $row['quantity'];
                            ?>" />
                            <span id="quantityError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['quantity'])) {
                                    echo $errorMessage['quantity'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                   <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Update Product" name="updateProduct" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </body>
</html>
