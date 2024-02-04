<?php
require_once "models/order.php";
require_once "models/company.php";

class OrdersController {

    public function mostrar() {
        $pedidosConDetalles = Order::obtenerPedidosConDetalles(); 
        
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

            Order::cambiarEstado($idPedido, $nuevoEstado);

            header("Location: index.php?controller=Orders&action=mostrar");
            exit();
        } else {
            echo "No se recibió el estado del pedido.";
        }
    }

    public function ticket() {
        $id_shopping = $_GET['ticket'];
        $dataCompany = Company::info();
        $company = new Company($dataCompany['id'], $dataCompany['name'], $dataCompany['cif'], $dataCompany['address']);
        $dataOrder = Order::obtenerDetallesPedido($id_shopping); //Detalles
        require_once "views/admin/ticket.php";
    }
}

?>
