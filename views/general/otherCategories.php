<div id="otherCategories">
    <h2>Other categories</h2>
    <div class="productContainer">
<?php        
    foreach ($otherCategories as $otherCategory) {
?>   
        <div>
            <p><?php echo $otherCategory['category_name']; ?></p>
            <img class="productImage" src="<?php echo $otherCategory['product_photo']; ?>" alt="<?php echo $otherCategory['category_name']; ?>">
        </div>
<?php
    }
?>
    </div>
</div>