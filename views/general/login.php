<div id="ls_container">
    <div id="background_ls">
        <!-- <marquee loop scrollamount="20" scrolldelay="60"><img src="sources/products/anime_tatoos.jpg" /><img src="sources/products/autumn_anime.jpg" /></marquee> -->
        <!-- <marquee scrollamount="20" scrolldelay="60"><img src="sources/products/autumn_anime.jpg" /></marquee> -->
    </div>
    <div id="login_signup">
        <form action="index.php?controller=User&action=checkLogin" autocomplete="off" method="post" enctype="multipart/form-data">
            <h1>LOGIN</h1>
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="send" value="Log in">
            <p><a href="index.php?controller=User&action=signup">Sign up</a></p>
        </form>
    </div>
</div>   