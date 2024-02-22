<?php
if (isset($_GET['id'])) {
    $idPedido = $_GET['id'];
} else {
    echo "No se recibió id.";
}
?>
<div id="containerAdmin">
<?php
        require_once("views/admin/sidebar.php");
?>
    <div id="invisibleSidebar"></div>
    <div id="adminContent">
        <div class="fullScreen">
            <h1 id="titleAdmin">Edit status of order <?php echo $idPedido?></h1>
            <form action="index.php?controller=Orders&action=actualizar" method="post">
                <?php
                echo "<input type='hidden' name='id_pedido' value='" . $idPedido . "'>"
                ?>

                <label for="estado">Status:</label>
                <select id="estado" name="estado">
                    <option value="pending">pending</option>
                    <option value="sent">sent</option>
                    <option value="cart">cart</option>
                </select>
                <input type="submit" value="Change status" id="changeStatus">
            </form>
        </div>
    </div>
</div>