<!DOCTYPE html>
<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>
   

        <div id="adminContent">
            <div class="fullScreen">
                <form action="index.php?controller=Category&action=add" method="post" enctype="multipart/form-data">
                    <h1 id="titleAdmin">NEW CATEGORY</h1>
                    <label for="name">Name: </label><input type="text" name="name" placeholder="Name" maxlength="100" required><br>
                    <input type="submit" name="send" id="changeActive" value="Enter">
                </form>
            </div>
        </div>
    </div>
</div>
</html>