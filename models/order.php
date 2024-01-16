<?php

require_once("BBDD.php");

class Order extends BBDD {

    private $id;
    private $estado;
    private $fecha_comanda;
    private $fecha_envio;
    private $email_comprador;
    private $precio_total_pedido;

    // ... (resto del código)

    // Actualizamos los nombres de las funciones según la nueva base de datos

    public function obtenerPedidos() {
        $query = "SELECT * FROM Shopping"; 
        $resultado = $this->connect()->query($query);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDetallesPedido($idPedido) {
        $query = "SELECT * FROM Shopping_details WHERE shopping = :idPedido";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function obtenerPedidosConDetalles() {
        $pedidos = $this->obtenerPedidos();
        $pedidosConDetalles = array();
        
        foreach ($pedidos as $pedido) {
            $detallesPedido = $this->obtenerDetallesPedido($pedido['id_shopping']);
            $pedidosConDetalles[$pedido['id_shopping']] = array(
                'pedido' => $pedido,
                'detalles' => $detallesPedido
            );
        }

        return $pedidosConDetalles;
    }

    public function cambiarEstado($idPedido, $nuevoEstado) {
        $query = "UPDATE Shopping SET status = :nuevoEstado WHERE id_shopping = :idPedido";
        $statement = $this->connect()->prepare($query);
        $statement->bindParam(':nuevoEstado', $nuevoEstado);
        $statement->bindParam(':idPedido', $idPedido);
        $statement->execute();
    }
}

?>
