<div id="header">
    <ul>
        <a href="index.php?controller=Product&action=principal"><li><img src="sources/web/logo.png" alt="logo"></li></a>
        <a href="index.php?controller=Product&action=products"><li>Products</li></a>
        <li class="dropdown">
            <a href="index.php?controller=Category&action=categories" class="dropbtn">Categories</a>
<?php 
            $categoryController = new CategoryController();
            $categoryController->showCategories();
?>
        </li>
        <a href="index.php?controller=PlateArt&action=plateart"><li>What's a PlateArt</li></a>
        <li><input type="text" placeholder="Search for a theme..."></li>
        <li><img src="sources/web/cart.png" alt="shopping cart"></li>
        <a href="index.php?controller=User&action=login"><li><img src="sources/web/user.png" alt="user"></li></a>
    </ul>
</div>