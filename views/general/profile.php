<div id="profile">
    <?php
        foreach ($myOrders as $Orders) {
            echo $Orders['client'];
            echo $Orders['shopping_date'];
            echo $Orders['status'];
            echo $Orders['total_price'];
        }
    ?>
    <a href="index.php?controller=User&action=logout"><button>Log out</button></a>
</div>