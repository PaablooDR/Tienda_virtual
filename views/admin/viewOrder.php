<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>

    <h1>Listado de Pedidos</h1>

    <?php foreach ($pedidosConDetalles as $pedidoConDetalles): ?>
        <h2>Pedido ID: <?php echo $pedidoConDetalles['pedido']['id_shopping']; ?></h2>
        <p>Estat: <?php echo $pedidoConDetalles['pedido']['status']; echo "<a href= 'index.php?controller=Orders&action=editar&id=" . $pedidoConDetalles['pedido']['id_shopping'] . "' >Editar </a></p>"; ?>
        <p>Data de Comanda: <?php echo $pedidoConDetalles['pedido']['shopping_date']; ?></p>
        <!-- Mostrar más detalles del pedido según sea necesario -->

        <h3>Detalles del Pedido:</h3>
        <ul>
            <?php foreach ($pedidoConDetalles['detalles'] as $detalle): ?>
                <li>
                    Código Producto: <?php echo $detalle['product']; ?> |
                    Cantidad: <?php echo $detalle['amount']; ?> |
                    Precio Total: <?php echo $detalle['total_price']; ?>€
                </li>
            <?php endforeach; ?>
        </ul>

        <p>Precio Total del Pedido: <?php echo $pedidoConDetalles['pedido']['total_price']; ?>€</p>
        <a href="index.php?controller=Orders&action=ticket&ticket=<?php echo $pedidoConDetalles['pedido']['id_shopping']; ?>"><button>Ticket</button></a>
        <hr>
    <?php endforeach; ?>
</div>
