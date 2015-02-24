<?php
$id = session_id();
if ($id == "") {
    session_start();
}

require 'ensureUserLoggedIn.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css.css" rel="stylesheet">
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="js/createProduct.js"></script>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <h1>Create Product Form</h1>
        <?php 
        if (isset($errorMessage)) {
            echo '<p>Error: ' . $errorMessage . '</p>';
        }
        ?>
        <form id="createProductForm"
              name="createProductForm"
              action="createProduct.php" 
              method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <input type="text" name="name" value="" />
                            <span id="nameError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <input type="text" name="description" value="" />
                            <span id="descriptionError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Cost</td>
                        <td>
                            <input type="text" name="costPrice" value="" />
                            <span id="costPriceError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sale Price</td>
                        <td>
                            <input type="text" name="salePrice" value="" />
                            <span id="salePriceError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>
                            <input type="text" name="quantity" value="" />
                            <span id="quantityError" class="error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" 
                                   value="Create Product" 
                                   name="createProduct" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
    </body>
</html>
