<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New product</title>
    </head>
    <body>
        <div>
            <form action="index.php?controller=Admin&action=addProduct" method="post" enctype="multipart/form-data">
                <h1>NEW PRODUCT</h1>
                Name:<input type="text" name="name" placeholder="Name" maxlength="100" required><br>
                Description:<input type="textarea" name="description" rows="4" cols="50" placeholder="Description" required><br>
                Category:
                <select name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['code'] . "," . $category['name']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select><br>
                Photo:<input type="file" name="photo" accept=".jpg, .png, .JPEG" required><br>
                Price:<input type="text" name="price" placeholder="Price" required><br>
                Stock:<input type="text" name="stock" placeholder="Stock" required><br>
                <input type="checkbox" name="outstanding" value="outstanding">Outstanding<br>
                <input type="submit" name="send" value="Enter">
            </form>
        </div>
    </body>
</html>