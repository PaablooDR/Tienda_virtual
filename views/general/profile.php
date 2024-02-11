<div id="profile">

    <h1>información personal</h1>
    <?php
        echo "Email: ".$_SESSION['user']['email']." "; 
        echo "Name: ".$_SESSION['user']['name']." ";
        echo "Surname: ".$_SESSION['user']['surname']." ";
        echo "Address: ".$_SESSION['user']['address']." ";
        echo "DNI: ".$_SESSION['user']['dni'];
    ?>

    <?php
        foreach ($myOrders as $Orders) {
            echo "<div>";
            echo "<div>Cliente: " . $Orders['client'] . "</div>";
            echo "<div>Fecha de compra: " . $Orders['shopping_date'] . "</div>";
            echo "<div>Estado: " . $Orders['status'] . "</div>";
            echo "<div>Precio total: " . $Orders['total_price'] . "</div>";
            echo "<div> <button id='btn-open-popup'>Ver pedido</button></div>";
            echo "</div>";
        }
        
    ?>
    <dialog id="popup">
        <h1>Funciona</h1>
        <button id='btn-close-popup'>Close</button>
    </dialog>


    <a href="index.php?controller=User&action=logout"><button>Log out</button></a>
</div>
<script src='js/profile.js'></script>