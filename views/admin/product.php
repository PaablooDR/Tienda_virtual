<!--Vista del admin a todo lo que puede hacer en productos-->

<a href="index.php?controller=Product&action=newProduct"><h3>New Product</h3></a>

<?php
echo "<form action='index.php?controller=Product&action=desactivateProduct' method='post' enctype='multipart/form-data'>";
    foreach($products as $product) {
        echo "<div>";
            echo "<div><input type='checkbox' name='selectedItems[]' value='".$product['code']."'></div>";
            echo "<div><img src='" . $product['photo'] . "' alt='" . $product['name'] . "' style='width: 150px;'></div>";
            echo "<div>".$product['name']."</div>";
            echo "<div>".$product['code']."</div>";
            echo "<div>".$product['category_name']."</div>";
            echo "<div>".$product['price']."</div>";
            echo "<div style='background: grenn;'>".$product['stock']."</div>";
            echo "<a href='index.php?controller=Product&action=editProduct&code=".$product['code']."'><div><img src='sources/edit.png' alt='edit' style='width: 50px;'></div></a>";
        echo "</div>";
    }
    echo "<input type='submit' name='desactivate' value='Change active'>";
echo "</form>";

?>
