<!--Vista del admin a todo lo que puede hacer en categorias-->

<a href="index.php?controller=Admin&action=newCategory"><h3>New Category</h3></a>

<?php
echo "<form action='index.php?controller=Admin&action=desactivateCategory' method='post' enctype='multipart/form-data'>";
    foreach($categories as $category) {
        echo "<div><input type='checkbox' name='selectedItems[]' value='".$category['code']."'></div>";
        echo "<div>".$category['code']."</div>";
        echo "<div>".$category['name']."</div>";
        echo "<a href='index.php?controller=Admin&action=editCategory&code=".$category['code']."'><div><img src='sources/edit.png' style='width: 150px;'></div></a>";
    }
    echo "<input type='submit' name='desactivate' value='Change active'>";
echo "</form>";
?>