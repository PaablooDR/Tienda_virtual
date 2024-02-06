<div id="containerAdmin">
    <?php 
        require_once("views/admin/sidebar.php")
    ?>
    <div id="adminContent">
        <h1>Stadistics</h1>
        <hr>
        <div class="titleStadistics"><p>Top Products</p> <p>Top Categories</p></div>
        <div class="titleStadistics">
            <canvas id="graficaEstadisticas" class="graficaEstadisticasStyle" width="500" height="325"></canvas>
            <canvas id="graficaEstadisticas2" class="graficaEstadisticasStyle" width="500" height="325"></canvas>
        </div>

        <script src="js/stadistics.js"></script>
        <?php
            $datosPHP = json_encode($topProductsQuantities);
            $productosPHP = json_encode($topProductsNames);
        ?>
        <script id="datosPHP" type="application/json">
            <?php echo $datosPHP; ?>
        </script>
        <script id="productosPHP" type="application/json">
            <?php echo $productosPHP; ?>
        </script>
        <?php 

           foreach ($topFiveCategories as $categoryData) {
                echo $categoryData;
            }
        ?>

    </div>

</div>



