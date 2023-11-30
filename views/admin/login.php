<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin login</title>
    </head>
    <body>
        <div>
            <form action="login.php" method="post" enctype="multipart/form-data">
                <h1>LOGIN</h1>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="send" value="Enter">
            </form>
        </div>
    </body>
</html>