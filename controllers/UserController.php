<?php
require_once("models/user.php");
require_once("models/order.php");

class UserController {
    //Menu
    public function users() {
        $users = User::users();
        require_once("views/admin/user.php");
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
            //echo "<script src='js/checkCart.js'></script>";
            $_SESSION["user"] = $user;
            //if (isset($_SESSION['cart']) && isset($_SESSION['totalPrice'])) {
            //     $existingCart = Order::checkExistantCart($_SESSION['user']['email']);
            //     if($existingCart == false) {
            //         $newId = Order::insertNewOrder($_SESSION['user']['email'], $_POST['totalPrice']);
            //         Order::insertShoppingDetails($newId, $_POST['cart']);
            //     } else {
            //         Order::updateTotalPrice($_SESSION['user']['email'], $_POST['totalPrice']);
            //         Order::insertShoppingDetails($existingCart, $_POST['cart']);
            //     }
            //}
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
        echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
    }

    public function signup() {
        require_once("views/general/signup.php");
    }

    public function checkSignUp() {
        $email = $_POST["email"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $dni = $_POST["dni"];
        $telephone = $_POST["telephone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $user = new User($email, $name, $surname, $telephone, $address, $password, $dni);
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