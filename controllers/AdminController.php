<?php
require_once("model/Admin.php");
class AdminController{
    public function login(){
        require_once("views/admin/login.php");
    }

    public function checkLogin(){
        echo "Iria al modelo";
        //Igular $POST
        $admin = new Admin($user, $pass, null);
        if ($admin->checkLogin()){
            //Redireccion al menu de admin
        } else {
            //Muestra error del login y vuelve al login
        }
    }

}

?>