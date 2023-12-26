<!--Vista del admin a todo lo que puede hacer en productos-->

<h1 id="titleAdmin">Products</h1>

<a href="index.php?controller=Product&action=new"><h3>New Product</h3></a>

<?php
echo "<form action='index.php?controller=Product&action=desactivate' method='post' enctype='multipart/form-data'>";
    foreach($products as $product) {
        echo "<div id='listProducts>";
            echo "<div><input type='checkbox' name='selectedItems[]' value='".$product['code']."'></div>";
            echo "<div><img src='" . $product['photo'] . "' alt='" . $product['name'] . "' style='width: 150px;'></div>";
            echo "<div>".$product['name']."</div>";
            echo "<div>".$product['code']."</div>";
            echo "<div>".$product['category_name']."</div>";
            echo "<div>".$product['price']."</div>";
            echo "<div>".$product['stock']."</div>";
            echo "<a href='index.php?controller=Product&action=edit&code=".$product['code']."&photo=".$product['photo']."'><div><img src='sources/web/edit.png' alt='edit' style='width: 50px;'></div></a>";
        echo "</div>";
    }
    echo "<input type='submit' name='desactivate' value='Change active'>";
echo "</form>";

?>
