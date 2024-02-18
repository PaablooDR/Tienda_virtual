<div id="containerAdmin">
    <?php 
        require_once("views/admin/sidebar.php")
    ?>
    <div id="invisibleSidebar"></div>
        <div id="adminContent">
            <div class="fullScreen">
                <h1 id="titleAdmin">Stadistics</h1>
                <div class="titleStadistics"><p>Top Products</p> <p>Top Categories</p></div>
                <div class="titleStadistics">
                    <canvas id="graficaEstadisticas" class="graficaEstadisticasStyle" width="500" height="325"></canvas>
                    <canvas id="graficaEstadisticas2" class="graficaEstadisticasStyle" width="500" height="325"></canvas>
                </div>

                <script src="js/stadistics.js"></script>
                <?php
                    $datosPHP = json_encode($topProductsQuantities);
                    $productosPHP = json_encode($topProductsNames);
                    $nameCategoriesPHP = json_encode($topFiveCategories);
                    $amountCategoriesPHP = json_encode($topFiveCategoriesAmount);
                ?>
                <script id="datosPHP" type="application/json">
                    <?php echo $datosPHP; ?>
                </script>
                <script id="productosPHP" type="application/json">
                    <?php echo $productosPHP; ?>
                </script>
                <script id="nameCategoriesPHP" type="application/json">
                    <?php echo $nameCategoriesPHP; ?>
                </script>
                <script id="amountCategoriesPHP" type="application/json">
                    <?php echo $amountCategoriesPHP; ?>
                </script>
            </div>
            
        </div>


</div>



