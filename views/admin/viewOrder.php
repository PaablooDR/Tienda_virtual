<div id="containerAdmin">
    <?php
        require_once("views/admin/sidebar.php");
    ?>
    <div id="invisibleSidebar"></div>
        <div id="adminContent">
            
            <h1 id="titleAdmin">Order List</h1>

            <?php foreach ($pedidosConDetalles as $pedidoConDetalles): ?>
                <div class="orderContainer">
                    <h2>Order ID: <?php echo $pedidoConDetalles['pedido']['id_shopping']; ?></h2>
                    <p>Status: <?php echo $pedidoConDetalles['pedido']['status']." "; echo "<a href= 'index.php?controller=Orders&action=editar&id=" . $pedidoConDetalles['pedido']['id_shopping'] . "' >Editar </a></p>"; ?>
                    <p>Order Date: <?php echo $pedidoConDetalles['pedido']['shopping_date']; ?></p>
                    <!-- Mostrar más detalles del pedido según sea necesario -->

                    <h3>Order Details:</h3>
                    <ul>
                        <?php foreach ($pedidoConDetalles['detalles'] as $detalle): ?>
                            <li>
                                Code product: <?php echo $detalle['product']; ?> |
                                Amount: <?php echo $detalle['amount']; ?> |
                                Total Price: <?php echo $detalle['total_price']; ?>€
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p>Order Total Price: <?php echo $pedidoConDetalles['pedido']['total_price']; ?>€</p>
                    <a href="index.php?controller=Orders&action=ticket&ticket=<?php echo $pedidoConDetalles['pedido']['id_shopping']; ?>"><button>Ticket</button></a>
                </div>
                        
            <?php endforeach; ?>
        </div>

</div>
