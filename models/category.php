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
}
?>