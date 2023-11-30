<?php
public class Admin{
    private $email;
    private $password;
    private $signature;

    //Getters
    function getEmail() {
        return $this->email;
    }
    function getPassword() {
        return $this->password;
    }
    function getSignature() {
        return $this->signature;
    }

    //Setters
    function getEmail($email) {
        $this->email = $email;
    }
    function getPassword($password) {
        $this->password = $password;
    }
    function getSignature($signature) {
        $this->signature = $signature;
    }

    //Methods
    public function checkLogin(){
        try {
            $conexion = new PDO("pgsql:host=localhost;dbname=PlateArt", "postgres", "root");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conexion->query("SELECT * FROM Admin WHERE email=$email AND password=$password");
            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                // Procesar cada fila de resultados
                print_r($fila);
            }
            
            // Recuerda cerrar la conexión
            $conexion = null;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }  
    }

}
?>