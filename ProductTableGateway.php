<?php

class ProductTableGateway {

    private $connection;
    
    public function __construct($c) {
        $this->connection = $c;
    }
    
    public function getProducts() {
        // execute a query to get all products
        $sqlQuery = "SELECT * FROM products";
        
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();
        
        if (!$status) {
            die("Could not retrieve products");
        }
        
        return $statement;
    }
    
    public function getProductById($id) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT * FROM products WHERE id = :id";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve product");
        }
        
        return $statement;
    }
    
    public function insertProduct($n, $d, $cp, $sp, $qty) {
        $sqlQuery = "INSERT INTO products " .
                "(name, description, costPrice, salePrice, quantity) " .
                "VALUES (:name, :description, :costPrice, :salePrice, :quantity)";
        
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "name" => $n,
            "description" => $d,
            "costPrice" => $cp,
            "salePrice" => $sp,
            "quantity" => $qty
            
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not insert product");
        }
        
        $id = $this->connection->lastInsertId();
        
        return $id;
    }
    
    public function deleteProduct($id) {
        $sqlQuery = "DELETE FROM products WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete product");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateProduct($id, $n, $d, $cp, $sp, $qty) {
        $sqlQuery =
                "UPDATE products SET " .
                "name = :name, " .
                "description = :description, " .
                "costPrice = :costPrice, " .
                "salePrice = :salePrice, " .
                "quantity = :quantity " .
                "WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id,
            "name" => $n,
            "description" => $d,
            "costPrice" => $cp,
            "salePrice" => $sp,
            "quantity" => $qty,
        );
        
        //echo '<pre>';
        //print_r($params);
        //echo '</pre>';

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }
    
    
}
    
