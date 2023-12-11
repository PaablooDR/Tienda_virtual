<!--Vista del admin a todo lo que puede hacer en categorias-->

<a href="index.php?controller=Admin&action=newCategory"><h3>New Category</h3></a>

<?php
echo "<form action='index.php?controller=Admin&action=desactivateCategory' method='post' enctype='multipart/form-data'>";
    foreach($categories as $category) {
        echo "<div><input type='checkbox' name='".array[]."' value='".$category['code']."' required></div>";
        echo "<div>".$category['code']."</div>";
        echo "<div>".$category['name']."</div>";
        echo "<div><img src='sources/edit.png' style='width: 150px;'></div>";
    }
    echo "<input type='submit' name='send' value='Delete'>";
echo "</form>";
?>