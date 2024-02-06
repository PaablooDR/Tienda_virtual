<div id="containerAdmin">
    <?php 
        require_once("views/admin/sidebar.php")
    ?>
    <div id="adminContent">
        <canvas id="graficaEstadisticas" width="500" height="350" style="border: solid 1px black;"></canvas>
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
    </div>

</div>



