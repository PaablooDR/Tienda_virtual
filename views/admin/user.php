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
                            <div><input type='checkbox' name='selectedItems[]' value='<?php echo $user['code']; ?>'></div>
                            <div><?php echo $user['dni']; ?></div>
                            <div><?php echo $user['email']; ?></div>
                            <div><?php echo $user['name']; ?></div>
                            <div><?php echo $user['surname']; ?></div>
                            <div><?php echo $user['telephone']; ?></div>
                            <div><?php echo $user['address']; ?></div>
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