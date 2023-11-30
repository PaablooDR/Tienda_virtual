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

    }

}
?>