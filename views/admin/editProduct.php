<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New product</title>
    </head>
    <body>
        <div>
            <!-- <?php print_r($data); ?> -->
            <form action="index.php?controller=Admin&action=updateProduct" method="post" enctype="multipart/form-data">
                <h1><?php echo "$data[0]"; ?></h1>
                <img src=<?php echo "$data[4]"; ?> alt="logo" style="width: 150px;"> <br>
                Name:<input type="text" name="name" placeholder="Name" value=<?php echo "$data[1]"; ?> maxlength="100" required><br>
                Description:<input type="textarea" name="description" rows="4" cols="50" placeholder="Description" value=<?php echo "$data[2]"; ?> required><br>
                Category:
                <select name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['code'] . "," . $category['name']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select><br>
                Photo:<input type="file" name="photo" accept=".jpg, .png, .JPEG" required><br>
                Price:<input type="text" name="price" placeholder="Price" value=<?php echo "$data[5]"; ?> required><br>
                Stock:<input type="text" name="stock" placeholder="Stock" value=<?php echo "$data[6]"; ?> required><br>
                <input type="submit" name="send" value="Enter">
            </form>
        </div>
    </body>
</html>