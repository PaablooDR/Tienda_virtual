<?php
class BBDD{
    //Methods
    public static function connect(){
        $connect = new PDO("pgsql:host=localhost;dbname=PlateArt", "postgres", "root");
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;
    }
}
?>