<?php
require_once "models/order.php";
require_once "models/company.php";
require_once "models/user.php";
require_once "models/category.php";
require_once "models/product.php";

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

    public function cart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['cart']) && isset($_POST['totalPrice'])) {
                $cart = json_decode($_POST['cart'], true); // Decode JSON

                $existingCart = Order::checkExistantCart($_SESSION['user']['email']);
                if($existingCart == false) {
                    $newId = Order::insertNewOrder($_SESSION['user']['email'], $_POST['totalPrice']);
                    foreach($cart as $detail) {
                        Order::insertShoppingDetails($newId, $detail);
                    }
                } else {
                    Order::updateTotalPrice($_SESSION['user']['email'], $_POST['totalPrice']);
                    foreach($cart as $detail) {
                        $existing = Order::existingShoppingDetails($existingCart, $detail);
                        if($existing != true) { 
                            Order::insertShoppingDetails($existingCart, $detail);
                        } else {
                            Order::updateShoppingDetails($existingCart, $detail);
                        }
                        $_SESSION['existing'] = $existing;
                    }
                }
                $_SESSION['cart'] = $cart;
            }
            
            $_SESSION['cart'] = $cart;
            $_SESSION['totalPrice'] = $_POST['totalPrice'];
        } else {
            // Manejar la solicitud de otra manera (opcional)
            echo 'Método no permitido';
        }
        //echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
    }
    
    public function profile() {
        $categories = category::obtain();
        require_once("views/general/header.php");
        $myOrders = Order::obtainMyOrders(); 
        $myOrdersDetailsArray = Order::obtainMyOrdersDetails(); 
        require_once("views/general/profile.php");
    }

    public function addAndCart() {
        if(isset($_GET['amount']) && isset($_GET['product'])) {
            $existingCart = Order::checkExistantCart($_SESSION['user']['email']);
            $productInfo = Product::getProductByCode($_GET['product']);
            $totalPrice = $_GET['amount'] * $productInfo[0]['price'];
            $detail = array(
                'productId' => $_GET['product'],
                'productPrice' => $productInfo[0]['price'],
                'productAmount' => $_GET['amount'],
                'totalPrice' => $productInfo[0]['price'] * $_GET['amount'],
            );
            if($existingCart == false) {
                $newId = Order::insertNewOrder($_SESSION['user']['email'], $totalPrice);
                Order::insertShoppingDetails($newId, $detail);
            } else {
                Order::updateTotalPrice($_SESSION['user']['email'], $totalPrice);
                $existing = Order::existingShoppingDetails($existingCart, $detail);
                if($existing != true) { 
                    Order::insertShoppingDetails($existingCart, $detail);
                } else {
                    Order::updateShoppingDetails($existingCart, $detail);
                }
            }
            if(isset($_GET['return'])) {
                echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=buyProduct&productCode='.$_GET['product'].'">';
            } else {
                echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Cart&action=logedUserCart">';
            }
        } else {
            echo "No se recibió el estado del pedido.";
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=buyProduct&productCode='.$_GET['product'].'">';
        }
    }

    public function payment() {
        $categories = category::obtain();
        $order = Order::checkExistantCart($_SESSION['user']['email']);
        $today = date("d/m/Y");
        require_once("views/general/header.php");
        require_once("views/general/payment.php");
    }

    public function orderPaid() {
        if(isset($_GET['order'])) {
            $idOrder = $_GET['order'];
            $products = Order::productsAmount($idOrder);
            foreach($products as $product) {
                Product::updateAmount($product['product'], $product['amount']);
            }
            Order::cambiarEstado($idOrder, 'pending');
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=principal">';
        } else {
            echo "No se recibió el estado del pedido.";
            echo '<meta http-equiv="refresh"content="0;url=index.php?controller=Product&action=buyProduct&productCode='.$_GET['product'].'">';
        }
    }
}

?>
