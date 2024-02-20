<div id="AdminLogin">
    <div>
        <img src="sources/web/logo.png" alt="logo">
        <h1>LOGIN</h1>
        <hr>
        <form action="index.php?controller=Admin&action=checkLogin" method="post" enctype="multipart/form-data">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="send" value="Login">
        </form>
    </div>
</div>