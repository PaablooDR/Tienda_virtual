<?php
    if(empty($categories)){
        echo "<p>No results have been found related to your search</p>";
    }else{
?>
        <div class="list">
            <div>Select all</div>
            <div>Code</div>
            <div>Name</div>
            <div>Edit</div>
        </div> 
<?php
        foreach ($categories as $category) {
?>
            <div class="list">
                <div> <input type='checkbox' name='selectedItems[]' value='<?php echo $category['code']; ?>'> </div>
                <div><?php echo $category['code']; ?></div>
                <div><?php echo $category['name']; ?></div>
                <a href='index.php?controller=Category&action=edit&code=<?php echo $category['code']; ?>'>
                    <div><img src='sources/web/edit.png' style='width: 150px;'></div>
                </a>
            </div>
<?php
        }
?>
        <input type='submit' name='desactivate' value='Change active'>
<?php
    }
?>