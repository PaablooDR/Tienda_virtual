<?php
require_once "models/order.php";
require_once "models/company.php";
require_once "models/user.php";
require_once "models/category.php";

class OrdersController {

    public function mostrar() {
        $pedidosConDetalles = Order::obtenerPedidosConDetalles(); 
        
        require_once "views/admin/viewOrder.php";
    }

    public function editar() {
        //$pedido = new Order();
        
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
        $dataOrderDetails = Order::obtenerDetallesPedido($id_shopping);
        $dataOrder = Order::obtainOrderById($id_shopping);
        $order = new Order($dataOrder['id_shopping'], $dataOrder['client'], $dataOrder['shopping_date'], $dataOrder['shopping_date'], $dataOrder['status'], $dataOrder['total_price'],);
        $client = new User($dataOrder['email'], $dataOrder['name'], $dataOrder['surname'], $dataOrder['telephone'], $dataOrder['address'], null, $dataOrder['dni']);
        require_once("views/admin/ticket.php");
    }

    // public function cart(){
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         // Recoger la información del carrito enviado desde el cliente
    //         $cart = $_POST['cart'];
    //         $totalPrice = $_POST['totalPrice'];

            
    //         $_SESSION['cart'] = $cart;
    //         $_SESSION['totalPrice'] = $totalPrice;
    //     } else {
    //         // Manejar la solicitud de otra manera (opcional)
    //         echo 'Método no permitido';
    //     }
    //     //echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
    // }
    
    public function profile() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        $myOrders = Order::obtainMyOrders(); 
        $myOrdersDetailsArray = Order::obtainMyOrdersDetails(); 
        require_once("views/general/profile.php");
    }
}

?>
