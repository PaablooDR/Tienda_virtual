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

        $category = new Category();
        $categories = $category->obtainCategories();

        require_once("views/admin/newProduct.php");
 
    }

    //Add new product
    public function addProduct() {
        $array = explode(",", $_POST["category"]);
        $category = $array[0];
        $categoryName = $array[1];
        $abbreviation1 = substr($categoryName, 0, 2);
        $abbreviation2 = substr($_POST["name"], 0, 2);
        $code = $abbreviation1 . '777-' . $abbreviation2;
        $name = $_POST["name"];
        $description = $_POST["description"];
        if(is_uploaded_file($_FILES['photo']['tmp_name'])){
            $path = $this->moveImage($code);
        }else{
            echo "<p>No se ha podido subir la imagen</p>";
        }
        $price = $_POST["price"];
        $stock = $_POST["stock"];
        $active = 1;
        if($_POST['outstanding'] == true){
            $outstanding = 1;
        }else{
            $outstanding = 0;
        }
        $product = new Product($code, $name, $description, $category, $path, $price, $stock, $active, $outstanding);
        $pro = $product->addProduct();
        if($pro == true) {
            echo "<script>
                alert('Insert completed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=products">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=products">';
        }
    }

    //Move image
    public function moveImage($name) {
        $originalName = $_FILES['photo']['name'];
        $imagen_ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $imagen_path = 'sources/'. $name .'.'. $imagen_ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $imagen_path);
        
        return $imagen_path;
    }

    //ADMIN CATEGORIES
    //Menu
    public function categories() {
        require_once("views/admin/sidebar.php");
        $category = new Category();
        $categories = $category->obtainCategories();
        require_once("views/admin/category.php");
        //Buscador + boton añadir categoria
        
    }

    //Form
    public function newCategory() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/newCategory.php");
    }

    //Add new category
    public function addCategory() {
        $name = $_POST['name'];
        $category = new Category(NULL, $name, 1);
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

    //ADMIN ORDERS
    //Menu
    public function orders() {
        require_once("views/admin/sidebar.php");
        // require_once("views/admin/order.php");
        //Buscador
        //Lista de pedidos con posibilidad de modificar
    }
}

?>