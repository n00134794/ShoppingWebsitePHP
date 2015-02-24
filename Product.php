<?php
class Product {
    private $name;
    private $description;
    private $costPrice;
    private $salePrice;
    private $quantity;
    
    public function __construct($n, $d, $cp, $sp, $qty) {
        $this->name = $n;
        $this->description = $d;
        $this->costPrice = $cp;
        $this->salePrice = $sp;
        $this->quantity = $qty;
    }
    
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getCostPrice() { return $this->costPrice; }
    public function getSalePrice() { return $this->salePrice; }
    public function getQuantity() { return $this->quantity; }
}
