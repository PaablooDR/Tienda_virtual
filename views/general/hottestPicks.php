<div id="hottestPicks">
    <h2>See the hottest picks</h2>
    <div class="productContainer">
<?php        
    foreach ($hottestPicks as $hottestPick) {
?>   
        <div>
            <img class="productImage" src="<?php echo $hottestPick['photo']; ?>" alt="<?php echo $hottestPick['name']; ?>">
        </div>
<?php
    }
?>
    </div>
    <p><a href="index.php?controller=Product&action=products">See more posters</a></p>
</div>