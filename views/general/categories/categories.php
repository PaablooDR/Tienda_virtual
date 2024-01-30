<div id="containerCategories">
    <div id="categoriesCenter">
        <div id="titleCategory">Categories</div>

        <?php foreach ($categories as $category): ?>
            <div class="category">
                <h2><?php echo $category['name']; ?></h2>

                <?php if (isset($productsByCategory[$category['code']]) && !empty($productsByCategory[$category['code']])): ?>
                    <div class="productsByCategory">
                        <?php foreach ($productsByCategory[$category['code']] as $product): ?>
                            <div class="productsIMG">
                                <img src="<?php echo $product['photo']; ?>" alt="<?php echo $product['name']; ?>">
                            </div>
                        <?php endforeach; ?>
                        <div class="seeMoreProducts">
                            <a href="">See more products</a>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No hay productos disponibles en esta categoría.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
