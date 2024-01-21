<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Category Products</title>
</head>
<body>
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
                                    <strong><?php echo $product['name']; ?></strong>
                                </div>
                            <?php endforeach; ?>
                            <div class="productsIMG">
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
</body>
</html>