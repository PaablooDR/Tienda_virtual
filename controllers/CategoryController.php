<?php
require_once("models/category.php");

class CategoryController {
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

    //Desactivate category
    public function desactivateCategory() {
        if(isset($_POST['desactivate'])) {
            if(isset($_POST['selectedItems'])) {
                foreach ($_POST["selectedItems"] as $selectedItem) {
                    $category = new Category($selectedItem);
                    $category->desactivate();
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
    }

    //Edit category
    public function editCategory() {
        if (isset($_GET['code'])){
            require_once("views/admin/sidebar.php");
            $code = $_GET['code'];
            $category = new Category();
            $category->setCode($code);
            $category->initialize();
            $data = $category->info();
            
            require_once("views/admin/editCategory.php");
        } else {
            echo "<script>
                alert('No identity');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
        }
    }

    //Updatear category
    public function updateCategory() {
        if(isset($_POST['send'])) {
            $code = $_GET['code'];
            $name = $_POST['name'];
            $category = new Category();
            $category->setName($name);
            $category->setCode($code);
            $category->update();
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Admin&action=categories">';
    }
}
?>