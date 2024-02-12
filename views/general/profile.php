<div id="profile">
    
    <h1>Personal information</h1>
    <?php
        echo "Email: ".$_SESSION['user']['email']." "; 
        echo "Name: ".$_SESSION['user']['name']." ";
        echo "Surname: ".$_SESSION['user']['surname']." ";
        echo "Address: ".$_SESSION['user']['address']." ";
        echo "DNI: ".$_SESSION['user']['dni'];
    ?>

    <?php
        foreach ($myOrders as $Orders) {
            $id = $Orders['id_shopping'];
            echo "<div class='orders-div'>";
            echo "<div>Code: " . $Orders['id_shopping'] . "</div>";
            echo "<div>Shopping date: " . $Orders['shopping_date'] . "</div>";
            echo "<div>Status: " . $Orders['status'] . "</div>";
            echo "<div>Total price: " . $Orders['total_price'] . "</div>";
            echo "<div> <button id='btn-open-popup'>Show order</button></div>";
            echo "<div> <button id='btn-open-popup'>Download bill</button></div>";
            echo "</div>";
            
            echo "<dialog id='popup'>";
                    foreach ($myOrdersDetailsArray[$id] as $orderDetail) {
                        echo "<div>Product: ".$orderDetail['product']."</div>";
                        echo "<div>Amount: ".$orderDetail['amount']."</div>";
                        echo "<div>Price: ".$orderDetail['total_price']."€</div>";
                       
                    }
            echo "<button id='btn-close-popup'>Close</button>";
            echo "</dialog>";
        }
        
    ?>



    <a href="index.php?controller=User&action=logout"><button>Log out</button></a>
</div>
<script src='js/profile.js'></script>