<?php
session_start();
require_once("models/admin.php");
require_once("models/product.php");
require_once("models/category.php");

class AdminController {
    public function login() {
        require_once("views/admin/login.php");
    }

    public function checkLogin() {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $admin = new Admin($email, $password, NULL);
        $usu = $admin->checkLogin();
        if($usu == true) {
            $_SESSION["admin"] = "admin";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Stadistics&action=stadistics">';
        } else {
            echo "<script>
                alert('Email or password are incorrect');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=login">';
        }
    }

    public function logout() {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=login">';
    }
}
?>