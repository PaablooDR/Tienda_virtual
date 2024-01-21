<?php
require_once("BBDD.php");
class User extends BBDD{
    private $email;
    private $name;
    private $surname;
    private $telephone;
    private $address;
    private $password;
    
    
    //Constructor
    public function __construct($email, $name, $surname, $telephone, $address, $password){
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->telephone = $telephone;
        $this->address = $address;
        $this->password = $password;
    }

    //Getters
    function getEmail() {
        return $this->email;
    }
    function getName() {
        return $this->name;
    }
    function getSurname() {
        return $this->surname;
    }
    function getTelephone() {
        return $this->telephone;
    }
    function getAddress() {
        return $this->address;
    }
    function getPassword() {
        return $this->password;
    }

    //Setters
    function setEmail($email) {
        $this->email = $email;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setSurname($surname) {
        $this->surname = $surname;
    }
    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
    function setAddress($address) {
        $this->address = $address;
    }
    function setPassword($password) {
        $this->password = $password;
    }

    //Methods
    public function checkSignUp() {
        try {
            $email = $this->email;
            $name = $this->name;
            $surname = $this->surname;
            $telephone = $this->telephone;
            $address = $this->address;
            //$password = $this->password;
            $password = password_hash($this->password, PASSWORD_BCRYPT);
            $connection = BBDD::connect();
            $stmt = $connection->prepare("SELECT * FROM Client WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($resultado) == 0) {
                $stmt = $connection->prepare("INSERT INTO Client (email, name, surname, telephone, address, password) VALUES (?, ?, ?, ?, ?, ?)");
                $success = $stmt->execute([$email, $name, $surname, $telephone, $address, $password]);
                if ($success) {
                    return true;
                } else {
                    return false;
                }
            }else{
                return false;
            }
            // Cerrar la conexión
            $connection = null;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }  
    }

    public static function checkLogin($email, $password){
        try {
            $connection = BBDD::connect();
            $stmt = $connection->prepare("SELECT * FROM Client WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                if(password_verify($password, $result['password'])) {
                    $data = [
                        'email' => $email,
                        'name' => $result['name'],
                        'surname' => $result['surname'],
                        'telephone' => $result['telephone'],
                        'address' => $result['address'],
                        'password' => $result['password']
                    ];
                    return $data;
                }
                else {
                    return false;
                }
            }else{
                return false;
            }
            // Cerrar la conexión
            $connection = null;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }  
    }

}
?>