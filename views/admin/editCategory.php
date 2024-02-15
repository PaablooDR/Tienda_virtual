<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>
   

        <div id="adminContent">
            <div class="fullScreen">

                <!-- <?php print_r($data); ?> -->
                <form action="index.php?controller=Category&action=update&code=<?php echo "$data[0]"; ?>" method="post" enctype="multipart/form-data">
                    <h1 id="titleAdmin">Edit Category <?php echo "$data[1]"; ?></h1>
                    Name: <input type="text" name="name" placeholder="Name" value=<?php echo "$data[1]"; ?> maxlength="100" required><br>
                    <input type="submit" name="send" id="changeActive" value="Update">
                </form>
            <div>
        </div>
    </div>
</div>