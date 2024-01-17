<?php
    if(empty($products)){
        echo "<p>No results have been found related to your search</p>";
    }else{
?>
        <div>Select all</div>
        <div>Photo</div>
        <div>Name</div>
        <div>Code</div>
        <div>Category</div>
        <div>Price</div>
        <div>Stock</div>
        <div>Edit</div>
<?php
        foreach ($products as $product) { 
?>
            <div class='list'>
                <div><input type='checkbox' name='selectedItems[]' value='<?php echo $product['code']; ?>'></div>
                <div><img src='<?php echo $product['photo']; ?>' alt='<?php echo $product['name']; ?>' style='width: 150px;'></div>
                <div><?php echo $product['name']; ?></div>
                <div><?php echo $product['code']; ?></div>
                <div><?php echo $product['category_name']; ?></div>
                <div><?php echo $product['price']; ?></div>
                <div><?php echo $product['stock']; ?></div>
                <a href='index.php?controller=Product&action=edit&code=<?php echo $product['code']; ?>&photo=<?php echo $product['photo']; ?>'>
                    <div><img src='sources/web/edit.png' alt='edit' style='width: 50px;'></div>
                </a>
            </div>
<?php 
        } 
?>
        <input type='submit' name='desactivate' value='Change active'>
<?php
    }
?>