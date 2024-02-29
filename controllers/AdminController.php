<?php
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
                Swal.fire({
                    title: 'Incorrect email or password',
                    text: 'Put the correct email or password',
                    icon: 'error',
                    showConfirmButton: false
                });
            </script>";
            echo '<meta http-equiv="refresh" content="2.5;url=index.php?controller=Admin&action=login">';
        }
    }

    public function logout() {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=login">';
    }

    public function signature() {
        //require_once("views/admin/sidebar.php");
        require_once("views/admin/signature.php");
    }

    public function saveSignature() {
        if (isset($_POST['signature'])) {
            $signature = $_POST['signature'];
            Admin::saveSignature($signature);
            // Render the view with the results of the search
            require_once("views/admin/signature.php");
        }
    }
}
?>