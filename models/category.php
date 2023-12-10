<?php
require_once("BBDD.php");
class Category extends BBDD{
    private $code;
    private $name;
    
    //Constructor
    public function __construct($code = NULL, $name){
        $this->code = $code;
        $this->name = $name;
    }

    //Getters
    function getCode() {
        return $this->code;
    }
    function getName() {
        return $this->name;
    }

    //Setters
    function setCode($code) {
        $this->code = $code;
    }
    function setName($name) {
        $this->name = $name;
    }

    //Methods
    public function addCategory() {
        try {
            $name = $this->name;
            $conexion = $this->conexion();
            $stmt = $conexion->prepare("INSERT INTO Category (name) VALUES (:name);");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $success = $stmt->execute();
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