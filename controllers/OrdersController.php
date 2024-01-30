<?php
require_once "models/order.php";

class OrdersController {

    public function mostrar() {
        $pedido = new Order();
        $pedidosConDetalles = $pedido->obtenerPedidosConDetalles(); 
        
        require_once "views/admin/viewOrder.php";
    }

    public function editar() {
        $pedido = new Order();
        
        require_once "views/admin/editOrder.php";
    }

    public function actualizar() {
        if (isset($_POST['estado'])) {
            $nuevoEstado = $_POST['estado'];
            $idPedido = $_POST['id_pedido'];

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
