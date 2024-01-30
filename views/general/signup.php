<div id="ls_container">
    <div id="background_ls">     
        
    </div>
    <div id="login_signup">
        <form action="index.php?controller=User&action=checkSignUp" autocomplete="off" method="post" enctype="multipart/form-data">
            <h1>SIGN UP</h1>
            <input type="email" name="email" placeholder="Email" maxlength="255" required><br>
            <input type="text" name="name" placeholder="Name" maxlength="50" required><br>
            <input type="text" name="surname" placeholder="Surname" maxlength="50" required><br>
            <input type="text" name="dni" placeholder="DNI" maxlength="100" required><br>
            <input type="number" name="telephone" placeholder="Telephone" maxlength="15" required><br>
            <input type="text" name="address" placeholder="Address" maxlength="255" required><br>
            <input type="password" name="password" placeholder="Password" maxlength="255" required><br>
            <input type="submit" name="send" value="Sign up" aria-label="Sign up button">
            <p><a href="index.php?controller=User&action=login" aria-label="Navigate to Log in page">Log in</a></p>
        </form>
    </div>
</div>
<script src='js/verifyInputs.js'></script>