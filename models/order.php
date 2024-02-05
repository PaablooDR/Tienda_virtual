<?php

require_once("BBDD.php");

class Order extends BBDD {

    private $id;
    private $estado;
    private $fecha_comanda;
    private $fecha_envio;
    private $email_comprador;
    private $precio_total_pedido;

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
}

?>
