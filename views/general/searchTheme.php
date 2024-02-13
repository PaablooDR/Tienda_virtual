<?php
    if(empty($products)){
        echo "<p>No results have been found related to your search</p>";
    }else{
        foreach ($products as $product) { 
?>
            <a href="index.php?controller=Product&action=buyProduct&productCode=<?php echo $product['code']; ?>"><?php echo $product['name']; ?></a>
<?php 
        }
    } 
?>