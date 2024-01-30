<div id="header">
    <ul>
        <a href="index.php?controller=Product&action=principal" aria-label="Navigate to home"><li><img src="sources/web/logo.png" alt="logo"></li></a>
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
        <a href="index.php?controller=Product&action=plateart" aria-label="Navigate to see info about our products"><li>What's a PlateArt</li></a>
        <li><input type="text" placeholder="Search for a theme..."></li>
        <li><img src="sources/web/cart.png" alt="shopping cart"></li>
        <a href="index.php?controller=User&action=login" aria-label="Navigate to login"><li><img src="sources/web/user.png" alt="user"></li></a>
    </ul>
</div>