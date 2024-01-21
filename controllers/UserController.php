<?php
require_once("models/user.php");

class UserController {
    //Menu
    public function users() {
        require_once("views/admin/sidebar.php");
        // require_once("views/admin/user.php");
        //Buscador
        //Lista de pedidos con posibilidad de modificar
    }

    public function login() {
        require_once("views/general/login.php");
    }

    public function checkLogin() {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = User::checkLogin($email, $password);
        if($user != false) {
            $_SESSION["user"] = $user;
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
        } else {
            echo "<script>
                alert('Email or password are incorrect');
            </script>";
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=User&action=login">';
        }
    }

    public function logout() {
        session_destroy();
        echo '<meta http-equiv="refreshcontent="0;url=index.php?controller=User&action=login">';
    }

    public function signup() {
        require_once("views/general/signup.php");
    }

    public function checkSignUp() {
        $email = $_POST["email"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $telephone = $_POST["telephone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $user = new User($email, $name, $surname, $telephone, $address, $password);
        $usu = $user->checkSignUp();
        if($usu) {
            echo '<script>alert("Registrado con exito");</script>';
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=User&action=login">';
        }
        else {
            echo '<script>alert("Error en el registro");</script>';
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=User&action=signup">';
        }
    }
}
?>