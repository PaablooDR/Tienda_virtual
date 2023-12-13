<!--Vista del admin a todo lo que puede hacer en categorias-->

<a href="index.php?controller=Category&action=new"><h3>New Category</h3></a>

<?php
echo "<form action='index.php?controller=Category&action=desactivate' method='post' enctype='multipart/form-data'>";
    foreach($categories as $category) {
        echo "<div><input type='checkbox' name='selectedItems[]' value='".$category['code']."'></div>";
        echo "<div>".$category['code']."</div>";
        echo "<div>".$category['name']."</div>";
        echo "<a href='index.php?controller=Category&action=edit&code=".$category['code']."'><div><img src='sources/web/edit.png' style='width: 150px;'></div></a>";
    }
    echo "<input type='submit' name='desactivate' value='Change active'>";
echo "</form>";
?>