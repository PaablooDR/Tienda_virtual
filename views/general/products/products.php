<div id="productsView">
    <?php
        foreach($products as $product){
        ?>
            <div class="productContainer">
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