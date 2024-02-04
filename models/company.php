<?php

require_once("BBDD.php");

class Company extends BBDD {
    private $id;
    private $name;
    private $cif;
    private $address;

    //Constructor
    public function __construct($id, $name, $cif, $address){
        $this->id = $id;
        $this->name = $name;
        $this->cif = $cif;
        $this->address = $address;
    }

    //Getters
    function getId() {
        return $this->id;
    }
    function getName() {
        return $this->name;
    }
    function getCif() {
        return $this->cif;
    }
    function getAddress() {
        return $this->address;
    }

    //Setters
    function setId($id) {
        $this->id = $id;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setCif($cif) {
        $this->cif = $cif;
    }
    function setAddress($address) {
        $this->address = $address;
    }
    
    //Methods
    public static function info() {
        try {
            $connect = BBDD::connect();

            $query = "SELECT * FROM Company";
            $statement = $connect->query($query);
            $company = $statement->fetch(PDO::FETCH_ASSOC);
            return $company;

        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Cerrar la conexión
        $connect = null;         
    }
}
?>
