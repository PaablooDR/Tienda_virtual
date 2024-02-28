
<button id="filterButton">Filters</button>
<div id="filtersPanel">
    <h2>Filter Options</h2>
    <?php
    require_once("views/general/products/filters.php");
    ?>
</div>
<div id="productsView">
<?php
    if($products != []){
        foreach($products as $product){
?>
            <div class="productContainer">
                <div class="imageContainer">
                    <a href="index.php?controller=Product&action=buyProduct&productCode=<?php echo $product->getCode();?>" aria-label="Navigate to see the product"><img class="productImage" src="<?php echo $product->getPhoto(); ?>" alt="<?php echo $product->getDescription(); ?>"></a>
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
    }else{
?>
        <p>There are no products available that meet your filter requirements</p>
<?php
    }
?>
</div>
<script src="./js/filters.js"></script>