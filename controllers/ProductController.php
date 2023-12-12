<?php
require_once("models/product.php");
require_once("models/category.php");

class ProductController {
    //Menu
    public function products() {
        require_once("views/admin/sidebar.php");
        $product = new Product();
        $products = $product->obtainProducts();
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
        if($_POST['outstanding'] == true){
            $outstanding = 1;
        }else{
            $outstanding = 0;
        }
        $product = new Product($code, $name, $description, $category, $path, $price, $stock, $outstanding);
        $pro = $product->addProduct();
        if($pro == true) {
            echo "<script>
                alert('Insert completed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
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

    //Desactivate product
    public function desactivateProduct() {
        if(isset($_POST['desactivate'])) {
            if(isset($_POST['selectedItems'])) {
                foreach ($_POST["selectedItems"] as $selectedItem) {
                    $product = new Product($selectedItem);
                    $product->desactivate();
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    }

    //Edit product
    public function editProduct() {
        if (isset($_GET['code'])){
            require_once("views/admin/sidebar.php");
            $code = $_GET['code'];
            $product = new Product();
            $product->setCode($code);
            $product->initialize();
            $data = $product->info();

            $category = new Category();
            $categories = $category->obtainCategories();
            
            require_once("views/admin/editProduct.php");
        } else {
            echo "<script>
                alert('No identity');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
        }
    }
}
?>