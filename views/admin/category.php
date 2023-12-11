<!--Vista del admin a todo lo que puede hacer en categorias-->

<a href="index.php?controller=Admin&action=newCategory"><h3>New Category</h3></a>

<?php
foreach($categories as $category) {
    echo "<div>".$category['code']."</div>";
    echo "<div>".$category['name']."</div>";
}

?>