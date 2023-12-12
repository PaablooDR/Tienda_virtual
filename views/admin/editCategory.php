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
            <form action="index.php?controller=Admin&action=updateCategory" method="post" enctype="multipart/form-data">
                Code:<input type="text" name="code" placeholder="Code" value=<?php echo "$data[0]"; ?> maxlength="100" disabled><br>
                Name:<input type="text" name="name" placeholder="Name" value=<?php echo "$data[1]"; ?> maxlength="100" required><br>
                <input type="submit" name="send" value="Update">
            </form>
        </div>
    </body>
</html>