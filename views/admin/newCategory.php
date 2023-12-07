<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New category</title>
    </head>
    <body>
        <div>
            <form action="index.php?controller=Admin&action=addCategory" method="post" enctype="multipart/form-data">
                <h1>NEW CATEGORY</h1>
                Code:<input type="text" name="code" placeholder="Code" maxlength="8" required><br> <!--Autogenerado?-->
                Name:<input type="text" name="name" placeholder="Name" maxlength="100" required><br>
                <input type="submit" name="send" value="Enter">
            </form>
        </div>
    </body>
</html>