<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New product</title>
    </head>
    <body>
        <div>
            <form action="index.php?controller=Product&action=updateProduct&code=<?php echo "$data[0]"; ?>" method="post" enctype="multipart/form-data">
                <?php print_r($data); ?>
                <h1><?php echo "$data[0]"; ?></h1>
                <img src=<?php echo "$data[4]"; ?> alt="logo" style="width: 150px;"> <br>
                Name:<input type="text" name="name" placeholder="Name" value="<?php echo "$data[1]"; ?>" maxlength="100" required><br>
                Description:<input type="textarea" name="description" rows="4" cols="50" placeholder="Description" value="<?php echo "$data[2]"; ?>" required><br>
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
                </select><br>
                Photo:<input type="file" name="photo" accept=".jpg, .png, .JPEG"><br>
                Price:<input type="number" name="price" placeholder="Price" value=<?php echo "$data[5]"; ?> required><br>
                Stock:<input type="number" name="stock" placeholder="Stock" value=<?php echo "$data[6]"; ?> required><br>
                <input type="submit" name="send" value="Enter">
            </form>
        </div>
    </body>
</html>