<?php
class BBDD{
    //Methods
    public function conexion(){
        $conexion = new PDO("pgsql:host=localhost;dbname=PlateArt", "postgres", "root");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    }
}
?>