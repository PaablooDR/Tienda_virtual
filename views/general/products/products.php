<div id="productsView">
    <?php
    foreach($products as $product){
    ?>
        <div class="productContainer" data-product-id="<?php echo $product['code']; ?>">
            <div class="imageOverlay">
                <img class="productImage" src="<?php echo $product['photo'] ?>">
                <div class="iconContainer">
                    <img class="productIcon" src="sources/web/addToCart.png">
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>