<div id="header">
    <div id="tamañoHeader">
        <ul>
            <a href="index.php?controller=Product&action=principal" aria-label="Navigate to home"><li class="marginHeader"><img src="sources/web/logo.png" alt="logo" id="logoPhoto"></li></a>
            <a href="index.php?controller=Product&action=products" aria-label="Navigate to see the products"><li>Products</li></a>
            <li class="dropdown">
                <a href="index.php?controller=Category&action=categories" class="dropbtn" aria-label="Navigate to see the categories">Categories</a>
                <ul class="dropdown-content">
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="index.php?controller=Product&action=singleCategory&id=<?php echo $category['code']; ?>" aria-label="Navigate to the category <?php echo $category['name']; ?>"> <?php echo $category['name']; ?> </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <a href="index.php?controller=Product&action=plateart"><li>What's a PlateArt</li></a>
            <li>
                <input type="text" placeholder="Search for a theme..." id="search">
                <div class="searchTheme" id="bodyList"></div>
            </li>
            <?php if(!isset($_SESSION['user'])) {?>
                <a href="index.php?controller=Cart&action=cart"><li><img src="sources/web/cart.png" alt="shopping cart"></li></a>
                <a href="index.php?controller=User&action=login" aria-label="Navigate to login"><li><img src="sources/web/user.png" alt="user"></li></a>
            <?php } else {?>
                <a href="index.php?controller=Cart&action=logedUserCart"><li><img src="sources/web/cart.png" alt="shopping cart"></li></a>
                <a href="index.php?controller=Orders&action=profile" aria-label="Navigate to your profile"><li><img src="sources/web/user.png" alt="user"></li></a>
            <?php } ?>
        </ul>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/searchBar.js"></script>