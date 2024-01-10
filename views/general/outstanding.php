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
    <div id="outstandingList">
        <?php
            foreach ($products as $product) {
                ?>
                <a href="index.php?controller=Product&action=buyProduct">
                    <div id="<?php echo $product['code']; ?>">
                        <img src="<?php echo $product['photo']; ?>" alt="<?php echo $product['name']; ?>">
                        <h4><?php echo $product['name']; ?></h4>
                        <p><?php echo $product['category_name']; ?></p>
                        <p><?php echo $product['price']; ?></p>
                    </div>
                </a>
                <?php
            }
        ?>
    </div>
</div>
