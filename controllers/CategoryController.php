<?php
require_once("models/category.php");

class CategoryController {

    //Categories
    public function categories() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        $categories = category::obtain();
        // Obtener los productos por cada categoría
        $productsByCategory = array();
        foreach ($categories as $category) {
            $categoryId = $category['code'];
            $productsByCategory[$categoryId] = Category::getProductsByCategory($categoryId);
        }

        require_once "views/general/categories/categories.php";
        
    }


    //Menu
    public function categoriesAdmin() {
        require_once("views/admin/sidebar.php");
        $categories = category::obtain();
        require_once("views/admin/category.php");
        //Buscador + boton añadir categoria
    }

    //Menu desplegable
    public function showCategories() {
        $categories = category::obtain();
        require_once("views/general/categories/allCategories.php");
    }

    //Search bar with Ajax
    public function search() {
        if (isset($_POST['search'])) {
            $searchValue = $_POST['search'];
            $categories = category::search($searchValue);
            // Render the view with the results of the search
            require_once("views/admin/searchCategory.php");
        }
    }    

    //Form
    public function new() {
        require_once("views/admin/sidebar.php");
        require_once("views/admin/newCategory.php");
    }

    //Add new category
    public function add() {
        $name = $_POST['name'];
        $category = new Category(NULL, $name, NULL);
        $cat = $category->add();
        if($cat == true) {
            echo "<script>
                alert('Insert completed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
        }
    }

    //Desactivate category
    public function desactivate() {
        if(isset($_POST['desactivate'])) {
            if(isset($_POST['selectedItems'])) {
                foreach ($_POST["selectedItems"] as $selectedItem) {
                    $category = new Category($selectedItem, NULL, NULL);
                    $category->desactivate();
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
    }

    //Edit category
    public function edit() {
        if (isset($_GET['code'])){
            require_once("views/admin/sidebar.php");
            $code = $_GET['code'];
            $name = category::initialize($code);
            $data = [$code, $name];
            require_once("views/admin/editCategory.php");
        } else {
            echo "<script>
                alert('No identity');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
        }
    }

    //Update category
    public function update() {
        if(isset($_POST['send'])) {
            $code = $_GET['code'];
            $name = $_POST['name'];
            $category = new Category($code, $name, NULL);
            $category->update();
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
    }
}
?>