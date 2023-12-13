<?php
require_once("models/category.php");

class CategoryController {
    //Menu
    public function categories() {
        require_once("views/admin/sidebar.php");
        $categories = category::obtainCategories();
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
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
        } else {
            echo "<script>
                alert('Insert failed');
            </script>";
            echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
        }
    }

    //Desactivate category
    public function desactivateCategory() {
        if(isset($_POST['desactivate'])) {
            if(isset($_POST['selectedItems'])) {
                foreach ($_POST["selectedItems"] as $selectedItem) {
                    $category = new Category($selectedItem, NULL);
                    $category->desactivate();
                }
            }
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
    }

    //Edit category
    public function editCategory() {
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
    public function updateCategory() {
        if(isset($_POST['send'])) {
            $code = $_GET['code'];
            $name = $_POST['name'];
            $category = new Category($code, $name);
            $category->update();
        }
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Category&action=categories">';
    }
}
?>