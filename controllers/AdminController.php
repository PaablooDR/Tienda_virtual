<?php
require_once("model/Admin.php");
class AdminController{
    public function login(){
        require_once("views/admin/login.php");
    }

    public function checkLogin(){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $admin = new Admin($email, $password);
        if ($admin->checkLogin()){
            //Redireccion al menu de admin
        } else {
            //Muestra error del login y vuelve al login
        }
    }

}

?>