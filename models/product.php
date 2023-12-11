<?php
require_once("BBDD.php");
class Product extends BBDD{
    private $code;
    private $name;
    private $description;
    private $category;
    private $photo;
    private $price;
    private $stock;
    private $outstanding;
    
    //Constructor
    // public function __construct($code, $name, $description, $category, $photo, $price, $stock, $outstanding){
    //     $this->code = $code;
    //     $this->name = $name;
    //     $this->description = $description;
    //     $this->category = $category;
    //     $this->photo = $photo;
    //     $this->price = $price;
    //     $this->stock = $stock;
    //     $this->outstanding = $outstanding;
    // }

    public function __construct($code=null, $name=null, $description=null, $category=null, $photo=null, $price=null, $stock=null, $outstanding=0){
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->photo = $photo;
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
    function getPhoto() {
        return $this->photo;
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
    function setPhoto($photo) {
        $this->photo = $photo;
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
    public function obtainCategories() {
        try {
            $connection = $this->conexion();
            $query = "SELECT * FROM Category";
            $statement = $connection->query($query);

            $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $categorias;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Cerrar la conexión
        $conexion = null;
        
    }

    public function addProduct(){
        try {
            $code = $this->code;
            $name = $this->name;
            $description = $this->description;
            $category = $this->category;
            $photo = $this->photo;
            $price = $this->price;
            $stock = $this->stock;
            $outstanding = $this->outstanding;
            $conexion = $this->conexion();
            $stmt = $conexion->prepare("INSERT INTO Product (code, name, description, category, photo, price, stock, outstanding) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $success = $stmt->execute([$code, $name, $description, $category, $photo, $price, $stock, $outstanding]);
            if ($success && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
            // Cerrar la conexión
            $conexion = null;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        } 
    }

}
?>