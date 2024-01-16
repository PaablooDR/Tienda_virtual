<?php
if (isset($_GET['id'])) {
    $idPedido = $_GET['id'];
} else {
    echo "No se recibió id.";
}
?>

<form action="index.php?controller=Orders&action=actualizar" method="post">
    <?php
    echo "<input type='hidden' name='id_pedido' value='" . $idPedido . "'>"
    ?>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado">
        <option value="pending">pending</option>
        <option value="sent">sent</option>
        <option value="cart">cart</option>
    </select>
    <input type="submit" value="Cambiar Estado">
</form>
