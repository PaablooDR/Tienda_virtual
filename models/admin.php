<?php
require_once("BBDD.php");
class Admin extends BBDD{
    private $email;
    private $password;
    private $signature;
    
    //Constructor
    public function __construct($email, $password, $signature){
        $this->email = $email;
        $this->password = $password;
        $this->signature = $signature;
    }

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
    function setEmail($email) {
        $this->email = $email;
    }
    function setPassword($password) {
        $this->password = $password;
    }
    function setSignature($signature) {
        $this->signature = $signature;
    }

    //Methods
    public function checkLogin(){
        try {
            $email = $this->email;
            $password = $this->password;
            $conexion = BBDD::connect();
            $stmt = $conexion->prepare("SELECT * FROM Admin WHERE email = :email AND password = :password");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($resultado) > 0) {
                return true;
            }else{
                return false;
            }
            // Cerrar la conexión
            $conexion = null;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }  
    }

    public static function saveSignature($signature){
        try{
            $sign = base64_decode(str_replace('data:image/png;base64,', '', $signature));
            $route = "sources/signature/signature.png";
            file_put_contents($route, $sign);
            $connect = BBDD::connect();
            if (!$connect) {
                die("Conexión fallida: " . mysqli_connect_error());
            }        
            $query = "UPDATE Admin SET signature = '$route' WHERE email = 'admin'";
            $connect->query($query);
            echo json_encode(['message' => 'Firma guardada exitosamente']);
        }catch (Exception $e) {
            echo json_encode(['message' => 'Error: ' . $e->getMessage()]);
        }       
    }
}
?>