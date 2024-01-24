<div id="outstanding">
    <div id="carousel">
        <?php
        $firstImage = true;
        foreach ($products as $product) {
            ?>
            <img src="<?php echo $product['photo']; ?>" alt="<?php echo $product['name']; ?>" <?php echo $firstImage ? 'style="display: block;"' : 'style="display: none;"'; ?>>
            <?php
            $firstImage = false;
        } 
        ?>
    </div>
    <div id="outstandingProducts">
        <div id="outstandingList">
            <?php
                foreach ($products as $product) {
                    ?>
                    <a href="index.php?controller=Product&action=buyProduct&productCode=<?php echo $product['code'];?>">
                        <div id="<?php echo $product['code']; ?>" class="outstandingProduct">
                            <img src="<?php echo $product['photo']; ?>" alt="<?php echo $product['name']; ?>">
                            <div id="outstandingAttributes">
                                <h4><?php echo ucfirst($product['name']); ?></h4>
                                <p><?php echo ucfirst($product['category_name']); ?></p>
                                <p><?php echo $product['price']; ?>€</p>
                                <button href="index.php?controller=Product&action=addCart">Add to cart</button>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

