<div>
    <form action="index.php?controller=User&action=checkLogin" method="post" enctype="multipart/form-data">
        <h1>LOGIN</h1>
        <input type="text" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="send" value="Enter">
        <p><a href="index.php?controller=User&action=signup">Sign up</a></p>
    </form>
</div>