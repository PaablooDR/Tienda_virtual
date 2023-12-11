<!--Vista del admin a todo lo que puede hacer en productos-->

<a href="index.php?controller=Admin&action=newProduct"><h3>New Product</h3></a>

<?php
print_r($products);
foreach($products as $product) {
    echo "<div>";
        echo "<div><img src='" . $product['photo'] . "' alt='" . $product['name'] . "' style='width: 150px;'></div>";
        echo "<div>".$product['name']."</div>";
        echo "<div>".$product['code']."</div>";
        echo "<div>".$product['category_name']."</div>";
        echo "<div>".$product['price']."</div>";
        echo "<div>".$product['stock']."</div>";
    echo "</div>";
    
}

?>
