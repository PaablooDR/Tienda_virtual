<?php

require_once("BBDD.php");

class Order extends BBDD {
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

    
}

?>
