<?php
require_once("BBDD.php");
class Product extends BBDD{
    private $code;
    private $name;
    private $description;
    private $category;
    private $price;
    private $stock;
    private $outstanding;
    
    //Constructor
    public function __construct($code, $name, $description, $category, $price, $stock, $outstanding){
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->stock = $stock;
        $this->outstanding = $outstanding;
    }

    //Getters
    function getCode() {
        return $this->code;
    }
    function getName() {
        return $this->name;
    }
    function getDescription() {
        return $this->description;
    }
    function getCategory() {
        return $this->category;
    }
    function getPrice() {
        return $this->price;
    }
    function getStock() {
        return $this->stock;
    }
    function getOutstanding() {
        return $this->outstanding;
    }


    //Setters
    function setCode($code) {
        $this->code = $code;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setDescription($description) {
        $this->description = $description;
    }
    function setCategory($category) {
        $this->category = $category;
    }
    function setPrice($price) {
        $this->price = $price;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setOutstanding($outstanding) {
        $this->outstanding = $outstanding;
    }


    //Methods


}
?>