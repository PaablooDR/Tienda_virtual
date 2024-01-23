<div id="login_signup">
    <form action="index.php?controller=User&action=checkSignUp" method="post" enctype="multipart/form-data">
        <h1>SIGN UP</h1>
        <input type="email" name="email" placeholder="Email" maxlength="255" required><br>
        <input type="text" name="name" placeholder="Name" maxlength="50" required><br>
        <input type="text" name="surname" placeholder="Surname" maxlength="50" required><br>
        <input type="number" name="telephone" placeholder="Telephone" maxlength="15" required><br>
        <input type="text" name="address" placeholder="Address" maxlength="255" required><br>
        <input type="password" name="password" placeholder="Password" maxlength="255" required><br>
        <input type="submit" name="send" value="Enter">
        <p><a href="index.php?controller=User&action=login">Log in</a></p>
    </form>
</div>