<?php
require_once("models/user.php");
require_once("models/order.php");
require_once("models/category.php");

class UserController {
    //Menu
    public function users() {
        $users = User::users();
        require_once("views/admin/user.php");
        //Buscador
        //Lista de pedidos con posibilidad de modificar
    }

    public function login() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        require_once("views/general/login.php");
    }

    public function checkLogin() {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = User::checkLogin($email, $password);
        if($user != false) {
            $_SESSION["user"] = $user;
            echo "<script src='js/checkCart.js'></script>";
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Incorrect email or password',
                    text: 'The email or password is wrong, try again',
                    icon: 'error',
                    showConfirmButton: false
                }); 
                </script>";
            echo '<meta http-equiv="refresh"content="2.5;url=index.php?controller=User&action=login">';
        }
    }

    public function logout() {
        session_destroy();
        echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
    }

    public function signup() {
        require_once("views/general/header.php");
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
            echo "<script>
                Swal.fire({
                    title: 'Welcome!',
                    icon: 'success',
                    showConfirmButton: false
                }); 
                </script>";
            echo '<meta http-equiv="refresh"content="2;url=index.php?controller=User&action=login">';
        }
        else {
            echo "<script>
                Swal.fire({
                    title: 'Something went wrong',
                    text: 'Enter the correct information',
                    icon: 'error',
                    showConfirmButton: false
                }); 
                </script>";
            echo '<meta http-equiv="refresh"content="2.5;url=index.php?controller=User&action=signup">';
        }
    }
}
?>