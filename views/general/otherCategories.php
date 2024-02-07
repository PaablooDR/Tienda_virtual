<div id="otherCategories">
    <h2>Other categories</h2>
    <div class="productContainer">
<?php        
    foreach ($otherCategories as $otherCategory) {
?>   
        <a href="index.php?controller=Product&action=singleCategory&id=<?php echo $otherCategory['code']; ?>" aria-label="Navigate to the category <?php echo $otherCategory['name']; ?>">
            <div>
                <p><?php echo $otherCategory['name']; ?></p>
                <img class="productImage" src="<?php echo $otherCategory['photo']; ?>" alt="<?php echo $otherCategory['name']; ?>">
            </div>
        </a>
<?php
    }
?>
    </div>
</div>