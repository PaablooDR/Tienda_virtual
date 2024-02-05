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
}

?>
