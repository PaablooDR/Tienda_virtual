<?php

require_once("BBDD.php");

class Order extends BBDD {

    private $id;
    private $email_comprador;
    private $fecha_comanda;
    private $fecha_envio;
    private $estado;
    private $precio_total_pedido;

    //Constructor
    public function __construct($id, $email_comprador, $fecha_comanda, $fecha_envio, $estado, $precio_total_pedido){
        $this->id = $id;
        $this->email_comprador = $email_comprador;
        $this->fecha_comanda = $fecha_comanda;
        $this->fecha_envio = $fecha_envio;
        $this->estado = $estado;
        $this->precio_total_pedido = $precio_total_pedido;
    }

    //Getters
    public function getId() {
        return $this->id;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getFechaComanda() {
        return $this->fecha_comanda;
    }
    public function getFechaEnvio() {
        return $this->fecha_envio;
    }
    public function getEmailComprador() {
        return $this->email_comprador;
    }
    public function getPrecioTotalPedido() {
        return $this->precio_total_pedido;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setFechaComanda($fecha_comanda) {
        $this->fecha_comanda = $fecha_comanda;
    }
    public function setFechaEnvio($fecha_envio) {
        $this->fecha_envio = $fecha_envio;
    }
    public function setEmailComprador($email_comprador) {
        $this->email_comprador = $email_comprador;
    }
    public function setPrecioTotalPedido($precio_total_pedido) {
        $this->precio_total_pedido = $precio_total_pedido;
    }

    public static function obtenerPedidos() {
        $query = "SELECT * FROM Shopping"; 
        $resultado = BBDD::connect()->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerDetallesPedido($idPedido) {
        $query = "SELECT * FROM Shopping_details WHERE shopping = :idPedido";
        $stmt = BBDD::connect()->prepare($query);
        $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public static function obtenerPedidosConDetalles() {
        $pedidos = Order::obtenerPedidos();
        $pedidosConDetalles = array();
        
        foreach ($pedidos as $pedido) {
            $detallesPedido = Order::obtenerDetallesPedido($pedido['id_shopping']);
            $pedidosConDetalles[$pedido['id_shopping']] = array(
                'pedido' => $pedido,
                'detalles' => $detallesPedido
            );
        }

        return $pedidosConDetalles;
    }

    public static function cambiarEstado($idPedido, $nuevoEstado) {
        $query = "UPDATE Shopping SET status = :nuevoEstado WHERE id_shopping = :idPedido";
        $statement = BBDD::connect()->prepare($query);
        $statement->bindParam(':nuevoEstado', $nuevoEstado);
        $statement->bindParam(':idPedido', $idPedido);
        $statement->execute();
    }

    public static function obtainOrderById($id) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("SELECT * FROM Shopping s JOIN Client c ON s.client = c.email WHERE s.id_shopping=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $res = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            } else {
                echo "Product not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    public static function obtainMyOrders(){
        $email = $_SESSION["user"]["email"];
        $query = "
            SELECT * 
            FROM Shopping
            WHERE client = :email;
        ";
        try {
            // Preparar la consulta utilizando PDO.
            $statement = BBDD::connect()->prepare($query);
            $statement -> bindParam(':email', $email, PDO::PARAM_INT);
            // Ejecutar la consulta.
            $statement->execute();

            // Obtener los resultados en un array.
            $myOrders = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Retornar los resultados.
            return $myOrders;

        } catch (PDOException $e) {
            // Manejar errores en caso de fallo en la consulta.
            // Puedes personalizar este bloque según tus necesidades.
            return null;
        }
    }
    public static function obtainMyOrdersDetails(){

        $myOrdersDetailsArray = array();

        $myOrders = self::obtainMyOrders();

        foreach ($myOrders as $order) {
            $id = $order['id_shopping'];

            $orderDetails = array();

            $query = "
                SELECT * 
                FROM shopping_details
                WHERE shopping = :id;
            ";
            try {
                // Preparar la consulta utilizando PDO.
                $statement = BBDD::connect()->prepare($query);
                $statement -> bindParam(':id', $id, PDO::PARAM_INT);
                // Ejecutar la consulta.
                $statement->execute();

                // Obtener los resultados en un array.
                $orderDetails = $statement->fetchAll(PDO::FETCH_ASSOC);


                $myOrdersDetailsArray[$id] = $orderDetails;

            } catch (PDOException $e) {
                // Manejar errores en caso de fallo en la consulta.
                // Puedes personalizar este bloque según tus necesidades.
                return null;
            }
        }
        return $myOrdersDetailsArray;
    }
    
    public static function checkExistantCart($client) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("SELECT * FROM Shopping WHERE client=:client AND status='cart'");
            $stmt->bindParam(':client', $client, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['id_shopping'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    public static function updateTotalPrice($user, $morePrice) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("UPDATE Shopping SET total_price=total_price+:more WHERE status='cart' AND client=:user");
            $stmt->bindParam(':more', $morePrice, PDO::PARAM_STR);
            $stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    public static function insertNewOrder($user, $totalPrice) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("INSERT INTO Shopping (client, shopping_date, status, total_price) VALUES (?, NOW(), 'cart', ?)");
            $success = $stmt->execute([$user, $totalPrice]);

            $id_shopping = $connect->lastInsertId();

            return $id_shopping;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    public static function insertShoppingDetails($id_shopping, $cart) {
        try {
            foreach($cart as $detail) { 
                $connect = BBDD::connect();
                $stmt = $connect->prepare("INSERT INTO shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (?, ?, ?, ?, ?)");
                $success = $stmt->execute([$id_shopping, $detail['productId'], $detail['productPrice'], $detail['productAmount'], $detail['totalPrice']]);
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }
}

?>
