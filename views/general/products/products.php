<div id="productsView">
    <?php
    foreach($products as $product){
    ?>
        <div class="productContainer">
            <div class="imageContainer">
                <a href="index.php?controller=Product&action=buyProduct&productCode=<?php echo $product->getCode();?>"><img class="productImage" src="<?php echo $product->getPhoto(); ?>"></a>
            </div>
            <div class="iconContainer">
                <img class="productIcon" src="sources/web/addToCart.png">
            </div>
            <div class="productInfo">
                <h3><?php echo $product->getName();?></h3>
                <h4><?php echo $product->getPrice();?> €</h4>
            </div>
        </div>
    <?php
    }
    ?>
</div>
