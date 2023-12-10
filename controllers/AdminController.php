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
        $admin = new Admin($email, $password);
        $usu = $admin->checkLogin();
        if($usu == true) {
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=stadistics">';
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
        require_once("views/admin/product.php");
        //Buscador + boton añadir producto
        //Lista de productos con posibilidad de modificar y desactivar
    }

    //Form
    public function newProduct() {
        require_once("views/admin/sidebar.php");

        $product = new Product();
        $categories = $product->obtainCategories();

        require_once("views/admin/newProduct.php");
 
    }

    //ADMIN CATEGORIES
    //Menu
    public function categories() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/category.php");
        //Buscador + boton añadir categoria
        //Lista de categorias con posibilidad de modificar y desactivar
    }

    //Form
    public function newCategory() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/newCategory.php");
    }

    //Add new category
    public function addCategory() {
        $name = $_POST['name'];
        $category = new Category(NULL, $name);
        $cat = $category->addCategory();
        if($cat == true) {
            echo "<script>
                alert('Insert completed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
        }
    }
}

?>