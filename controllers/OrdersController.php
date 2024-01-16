<?php

class OrdersController {

    public function mostrar() {
        require_once "models/order.php";
        $pedido = new Order();
        $pedidosConDetalles = $pedido->obtenerPedidosConDetalles(); 
        
        require_once "views/admin/viewOrder.php";
    }

    public function editar() {
        require_once "models/order.php";
        $pedido = new Order();
        
        require_once "views/admin/editOrder.php";
    }

    public function actualizar() {
        if (isset($_POST['estado'])) {
            $nuevoEstado = $_POST['estado'];
            $idPedido = $_POST['id_pedido'];

            require_once "models/order.php";
            $pedido = new Order();
            $pedido->cambiarEstado($idPedido, $nuevoEstado);

            header("Location: index.php?controller=Orders&action=mostrar");
            exit();
        } else {
            echo "No se recibió el estado del pedido.";
        }
    }
}

?>
