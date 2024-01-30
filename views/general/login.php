<div id="ls_container">
    <div id="background_ls">
        
    </div>
    <div id="login_signup">
        <form action="index.php?controller=User&action=checkLogin" autocomplete="off" method="post" enctype="multipart/form-data">
            <h1>LOG IN</h1>
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="send" value="Log in" aria-label="Log in button">
            <p><a href="index.php?controller=User&action=signup" aria-label="Navigate to sign up page">Sign up</a></p>
        </form>
    </div>
</div>   