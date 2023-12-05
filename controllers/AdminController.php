<?php
require_once("models/admin.php");
class AdminController{
    public function login(){
        require_once("views/admin/login.php");
    }

    public function checkLogin(){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $admin = new Admin($email, $password);
        $usu = $admin->checkLogin();
        if ($usu == true){
            //Redireccion al menu de admin
        } else {
            echo "<script>
                alert('Email or password are incorrect');
            </script>";
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.php?controller=Admin&action=login">';
        }
    }

    public function stadistics() {
        require_once("views/admin/sidebar.php");
    }

    public function products() {
        require_once("views/admin/sidebar.php");
    }
}

?>