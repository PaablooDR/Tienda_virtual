

<canvas id="graficaEstadisticas" width="500" height="400"></canvas>
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

