<!--Vista del admin a todo lo que puede hacer en productos-->

<div id="adminContent">
    <h1 id="titleAdmin">Products</h1>

    <a href="index.php?controller=Product&action=new"><h3>New Product</h3></a>


    <form action='index.php?controller=Product&action=desactivate' method='post' enctype='multipart/form-data'>
        <div class="list">
            <div>Select all</div>
            <div>Photo</div>
            <div>Name</div>
            <div>Code</div>
            <div>Category</div>
            <div>Price</div>
            <div>Stock</div>
            <div>Edit</div>
        </div>
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
    </form>

</div>
