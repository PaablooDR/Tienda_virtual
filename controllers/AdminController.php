<?php
require_once("models/admin.php");
class AdminController {
    public function login() {
        require_once("views/admin/login.php");
    }

    public function checkLogin() {
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
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=login">';
        }
    }

    //ADMIN STADISTICS
    //Menu
    public function stadistics() {
        require_once("views/admin/sidebar.php");
    }

    //ADMIN PRODUCTS
    //Menu
    public function products() {
        require_once("views/admin/sidebar.php");
        //Buscador + boton añadir producto
        //Lista de productos con posibilidad de modificar y desactivar
    }

    //Form
    public function newProduct() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/newProduct.php");
    }

    //ADMIN CATEGORIES
    //Menu
    public function categories() {
        require_once("views/admin/sidebar.php");
        //Buscador + boton añadir categoria
        //Lista de categorias con posibilidad de modificar y desactivar
    }

    //Form
    public function newCategories() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/newCategory.php");
    }

    //Add new category
    public function addCategory() {
        $name = $_POST['name'];
        $category = new Category($name);
        $cat = $category->addCategory();
        if($cat == true) {
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
        } else {
            echo "<script>
                <alert>Insert failed</alert>
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
        }
    }
}

?>