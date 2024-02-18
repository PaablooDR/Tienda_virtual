<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>
   

        <div id="adminContent">
            <div class="fullScreen">
                <form action="index.php?controller=Product&action=update&code=<?php echo "$data[0]"; ?>&photo=<?php echo "$data[4]"; ?>" method="post" enctype="multipart/form-data">
                    <!-- <?php print_r($data); ?> -->
                    <h1><?php echo "$data[0]"; ?></h1>
                    <img src=<?php echo "$data[4]"; ?> alt="logo" style="width: 150px;"> <br><br>
                    Name: <input type="text" name="name" placeholder="Name" value="<?php echo "$data[1]"; ?>" maxlength="100" required><br><br>
                    Description: <input type="textarea" name="description" rows="4" cols="50" placeholder="Description" value="<?php echo "$data[2]"; ?>" required><br><br>
                    Category:
                    <select name="category">
                        <option value="<?php echo $data[3] . "," . $data[7]; ?>"><?php echo $data[7]; ?></option>
                        <?php
                            foreach($categories as $category) {
                                if($data[7] != $category['name']) {
                        ?>
                                    <option value="<?php echo $category['code'] . "," . $category['name']; ?>"><?php echo $category['name']; ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select><br><br>
                    New photo: <input type="file" name="photo" accept=".jpg, .png, .JPEG"><br><br>
                    Price: <input type="number" name="price" placeholder="Price" value=<?php echo "$data[5]"; ?> required><br><br>
                    Stock: <input type="number" name="stock" placeholder="Stock" value=<?php echo "$data[6]"; ?> required><br>
                    <input type="submit" name="send" id="changeActive" value="Enter">
                </form>
            </div>
        </div>
        
</html>