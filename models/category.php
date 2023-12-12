<?php
require_once("BBDD.php");
class Category extends BBDD{
    private $code;
    private $name;
    private $active;
    
    //Constructor
    public function __construct($code = NULL, $name = NULL, $active = NULL){
        $this->code = $code;
        $this->name = $name;
        $this->active = $active;
    }

    //Getters
    function getCode() {
        return $this->code;
    }
    function getName() {
        return $this->name;
    }
    function getActive() {
        return $this->active;
    }

    //Setters
    function setCode($code) {
        $this->code = $code;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setActive($active) {
        $this->active = $active;
    }

    //Methods
    //Obtain categories
    public function obtainCategories() {
        try {
            $connect = $this->conexion();
            $query = "SELECT * FROM Category";
            $statement = $connect->query($query);

            $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $categorias;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }
    
    //Insert category
    public function addCategory() {
        try {
            $name = $this->name;
            $conexion = $this->conexion();
            $stmt = $conexion->prepare("INSERT INTO Category (name, active) VALUES (?, ?)");
            $success = $stmt->execute([$name, 1]);
            if ($success && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Cerrar la conexión
        $conexion = null;    
    }

    //Desactivate category
    public function desactivate() {
        $code = $this->code;
        try {
            $connect = $this->conexion();
            $stmt = $connect->prepare("UPDATE Category SET active = NOT active WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Initialize the attributs of the class
    public function initialize() {
        $code = $this->code;
        try {
            $connect = $this->conexion();
            $stmt = $connect->prepare("SELECT name FROM Category WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $res = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $this->setName($result['name']);
            } else {
                echo "Category not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Category info
    public function info() {
        return [$this->code, $this->name];
    }

    //Update category
    public function update() {
        $code = $this->code;
        $name = $this->name;
        try {
            $connect = $this->conexion();
            $stmt = $connect->prepare("UPDATE Category SET name = :name WHERE code = :code");
            $stmt->bindParam(':name', $name, PDO::PARAM_INT);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }
}
?>