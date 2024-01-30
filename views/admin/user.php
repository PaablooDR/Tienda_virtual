<div id="containerAdmin">
<?php
        require_once("views/admin/sidebar.php");
?>

    <div id="adminContent">
        <h1 id="titleAdmin">Users</h1>

        <form action='index.php?controller=Product&action=desactivate' method='post' enctype='multipart/form-data'>
            <div id="bodyList" class="list">
                <div>Select all</div>
                <div>DNI</div>
                <div>Email</div>
                <div>Name</div>
                <div>Surname</div>
                <div>Telephone</div>
                <div>Address</div>
    <?php
                if($users != false) {
                    foreach ($users as $user) { 
    ?>
                        <div class='list'>
                            <div><input type='checkbox' name='selectedItems[]' value='<?php echo $product['code']; ?>'></div>
                            <div><?php echo $product['dni']; ?></div>
                            <div><?php echo $product['email']; ?></div>
                            <div><?php echo $product['name']; ?></div>
                            <div><?php echo $product['surname']; ?></div>
                            <div><?php echo $product['telephone']; ?></div>
                            <div><?php echo $product['address']; ?></div>
                        </div>
    <?php 
                    }
                } else {
    ?>
                    <p>There's no users on the database</p>
    <?php
                }
    ?>
                <input type='submit' name='desactivate' value='Change active'>
            </div>
        </form>
    </div>
</div>