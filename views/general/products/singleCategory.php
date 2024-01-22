<div id="productsView">
    <?php
    if(!empty($products)){
        foreach($products as $product){
?>
            <div class="productContainer">
                <div class="imageContainer">
                    <a href="index.php?controller=Product&action=buyProduct&productCode=<?php echo $product['code'];?>"><img class="productImage" src="<?php echo $product['photo'] ?>"></a>
                </div>
                <div class="iconContainer">
                    <img class="productIcon" src="sources/web/addToCart.png">
                </div>
                <div class="productInfo">
                    <h3><?php echo $product['name'];?></h3>
                    <h4><?php echo $product['price'];?> €</h4>
                </div>
            </div>
<?php
        }
    }else{
        echo "<p>No hay productos disponibles en esta categoría.</p>";
    }
?>
</div>