<?php
require_once("models/product.php");
require_once("models/category.php");

class ProductController {
    //Menu
    public function productsAdmin() {
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
    
    public function search2() {
        if (isset($_POST['search2'])) {
            $searchValue = $_POST['search2'];
            $products = Product::search2($searchValue);
            // Render the view with the results of the search
            require_once("views/general/searchTheme.php");
        }
    }

    //Single category
    public function singleCategory() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        $code = $_GET["id"];
        $products = Product::specificCategory($code);
        require_once("views/general/products/singleCategory.php");
        require_once("views/general/footer.php");
    }

    //Form
    public function new() {
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
        $abbreviation3 = Product::zeroFill(intval($number)+1);

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
        if(isset($_POST['outstanding'])){
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
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=productsAdmin">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="5;url=index.php?controller=Product&action=productsAdmin">';
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
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=productsAdmin">';
    }

    //Form to edit product
    public function edit() {
        if (isset($_GET['code'])){
           
            $code = $_GET['code'];
            $ini = Product::initialize($code);
            $product = new Product($code, $ini[0], $ini[1], $ini[2], $ini[3], $ini[4], $ini[5], NULL, $ini[6]);
            $data = $product->info();
            $categories = Category::obtain();
            require_once("views/admin/editProduct.php");
        } else {
            echo "<script>
                alert('No identity');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=productsAdmin">';
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
            if(isset($_POST['outstanding'])){
                $outstanding = 1;
            }else{
                $outstanding = 0;
            }
            if(is_uploaded_file($_FILES['photo']['tmp_name'])){
                Product::removeImage($path);
                $newPath = Product::moveImage($code);
                $product = new Product($code, $name, $description, $category, $newPath, $price, $stock, NULL, $outstanding);
            } else {
                $product = new Product($code, $name, $description, $category, $path, $price, $stock, NULL, $outstanding);
            }

            
            $product->update();
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=productsAdmin">';
    }
    //Shop
    //Principal page
    public function principal() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        $products = Product::outstandingProducts();
        require_once("views/general/outstanding.php");
        require_once("views/general/video.php");
        $hottestPicks = Product::hottestPicks();
        require_once("views/general/hottestPicks.php");
        $otherCategories = Product::otherCategories();
        require_once("views/general/otherCategories.php");
        require_once("views/general/footer.php");
    }

    public function products(){ 
        $categories = category::obtain(); 
        require_once("views/general/header.php"); 
        // Obtener parámetros de la URL
        $categoryCode = isset($_GET['categoryCode']) ? $_GET['categoryCode'] : null; 
        $minPrice = isset($_GET['min']) ? $_GET['min'] : null; 
        $maxPrice = isset($_GET['max']) ? $_GET['max'] : null; 
        $order = isset($_GET['order']) ? $_GET['order'] : null; 
        // Obtener productos filtrados 
        $products = Product::obtainActiveProducts($categoryCode, $minPrice, $maxPrice, $order); 
        require_once("views/general/products/products.php");
        require_once("views/general/footer.php");
    }  
    public function buyProduct(){
        $categories = category::obtain();
        require_once("views/general/header.php");
        $product = Product::getProductByCode($_GET['productCode']);
        require_once("views/general/products/buyProduct.php");
        echo "<script src='./js/productDrawers.js'></script>";
        require_once("views/general/footer.php");
    }
    public function plateart(){
        $categories = category::obtain();
        require_once("views/general/header.php");
        require_once("views/general/whatsaPlateArt.php");
        require_once("views/general/footer.php");
    }
}
?>