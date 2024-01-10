<div id="outstanding">
    <div id="carousel">
        <?php
        foreach ($products as $product) {
        ?>
            <img src="<?php echo $product['photo']; ?>" alt="<?php echo $product['name']; ?>">
        <?php 
        } 
        ?>
    </div>
</div>