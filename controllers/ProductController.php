<?php
require_once("models/product.php");
require_once("models/category.php");

class ProductController {
    //Menu
    public function productsAdmin() {
        require_once("views/admin/sidebar.php");
        $products = Product::obtain();
        require_once("views/admin/product.php");
        //Buscador + boton añadir producto
        //Lista de productos con posibilidad de modificar y desactivar
    }

    //Search bar with Ajax
    public function search() {
        if (isset($_POST['search'])) {
            $searchValue = $_POST['search'];
            $products = Product::search($searchValue);
            // Render the view with the results of the search
            require_once("views/admin/searchProduct.php");
        }
    }   

    //Single category
    public function singleCategory() {
        require_once("views/general/header.php");
        $code = $_GET["id"];
        $products = Product::specificCategory($code);
        require_once("views/general/products/singleCategory.php");
    }

    //Form
    public function new() {
        require_once("views/admin/sidebar.php");
        $categories = Category::obtain();
        require_once("views/admin/newProduct.php");
    }

    //Add new product
    public function add() {
        $array = explode(",", $_POST["category"]);
        $category = $array[0];
        $categoryName = $array[1];
        $abbreviation1 = substr($categoryName, 0, 2);
        $abbreviation2 = substr($_POST["name"], 0, 2);

        $number = Product::count($category);
        $abbreviation3 = Product::zeroFill($number+10);

        $code = $abbreviation1 . $abbreviation3 . '-' . $abbreviation2;

        $name = $_POST["name"];
        $description = $_POST["description"];

        if(is_uploaded_file($_FILES['photo']['tmp_name'])){
            $path = Product::moveImage($code);
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
        $product = new Product($code, $name, $description, $category, $path, $price, $stock, 1, $outstanding);
        $pro = $product->insert();
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

    //Desactivate product
    public function desactivate() {
        if(isset($_POST['desactivate'])) {
            if(isset($_POST['selectedItems'])) {
                foreach ($_POST["selectedItems"] as $selectedItem) {
                    $product = new Product($selectedItem, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
                    $product->desactivate();
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    }

    //Form to edit product
    public function edit() {
        if (isset($_GET['code'])){
            require_once("views/admin/sidebar.php");
            $code = $_GET['code'];
            $ini = Product::initialize($code);
            $product = new Product($code, $ini[0], $ini[1], $ini[2], $ini[3], $ini[4], $ini[5], NULL, NULL);
            $data = $product->info();
            $categories = Category::obtain();
            require_once("views/admin/editProduct.php");
        } else {
            echo "<script>
                alert('No identity');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
        }
    }

    //Update product
    public function update() {
        if(isset($_POST['send'])) {
            $code = $_GET['code'];
            $path = $_GET['photo'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $arrayCategory = explode(",", $_POST['category']);
            $category = $arrayCategory[0];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            if(is_uploaded_file($_FILES['photo']['tmp_name'])){
                Product::removeImage($path);
                $newPath = Product::moveImage($code);
                $product = new Product($code, $name, $description, $category, $newPath, $price, $stock, NULL, NULL);
            } else {
                $product = new Product($code, $name, $description, $category, $path, $price, $stock, NULL, NULL);
            }

            
            $product->update();
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    }
    //Get a product with his ID
    public function getProductById(){

    }

    //Shop
    //Principal page
    public function principal() {
        require_once("views/general/header.php");
        $products = Product::outstandingProducts();
        require_once("views/general/outstanding.php");
        require_once("views/general/video.php");
        echo "<script src='js/carousel.js'></script>";
    }

    public function products(){
        require_once("views/general/header.php");
        $products = Product::obtain();
        require_once("views/general/products/products.php");
    }
    public function buyProduct(){
        require_once("views/general/header.php");
        $products = Product::obtain();
        require_once("views/general/products/buyProduct.php");
    }
}
?>