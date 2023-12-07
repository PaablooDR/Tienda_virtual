<?php
require_once("BBDD.php");
class Category extends BBDD{
    private $code;
    private $name;
    
    //Constructor
    public function __construct($name){
        //$this->code = $code;
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
        $name = $this->name;
        $conexion = $this->conexion();
        $stmt = $conexion->prepare("INSERT INTO Category VALUES (:name)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }

}
?>