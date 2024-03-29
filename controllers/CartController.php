<?php
require_once "models/order.php";
require_once "models/company.php";
require_once "models/user.php";
require_once "models/category.php";
class cartController{
    public function obtainCartStorage(){
        $postData = json_decode(file_get_contents("php://input"), true);

        // Aquí procesa los datos del carrito
        $cartData = $postData['cartData'];

        // Ejemplo de procesamiento (puedes ajustar según tus necesidades)
        $response = $this->processCartData($cartData);

        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    private function processCartData($cartData) {

        return ['status' => 'success', 'message' => 'Datos del carrito recibidos correctamente.'];
    }

    public function cart(){
        $categories = Category::obtain();
        require_once "views/general/header.php";
        require_once "views/general/cart/cart.php";
        require_once("views/general/footer.php");
    }

    public function logedUserCart() {
        echo "<script src='js/logedUserCart.js'></script>";
        $categories = Category::obtain();
        $cartInfo = Order::getLogedUserCartInfo();
        require_once "views/general/header.php";
        require_once "views/general/cart/logedUserCart.php";
        require_once("views/general/footer.php");
    }
}
?>