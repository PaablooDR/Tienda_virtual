<div class="dropdown-content">
    <?php foreach ($categories as $category): ?>
        <a href="index.php?controller=Product&action=singleCategory&id=<?php echo $category['code']; ?>">
            <?php echo $category['name']; ?>
        </a>
    <?php endforeach; ?>
</div>