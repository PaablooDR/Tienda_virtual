<div id="profile">
    <div id="profile-div">
        <h1>Personal information</h1>
        <div class="user-info">
            <div><b>Email:</b> <?php echo $_SESSION['user']['email']; ?></div>
            <div><b>Name:</b> <?php echo $_SESSION['user']['name']; ?></div>
            <div><b>Surname:</b> <?php echo $_SESSION['user']['surname']; ?></div>
            <div><b>Address:</b> <?php echo $_SESSION['user']['address']; ?></div>
            <div><b>DNI:</b> <?php echo $_SESSION['user']['dni']; ?></div>
        </div>
        <a href="index.php?controller=User&action=logout"><button id="logOut">Log out</button></a>
        <h1>My Orders</h1>
        <?php
            foreach ($myOrders as $Orders) {
                $id = $Orders['id_shopping'];
                echo "<div class='orders-div'>";
                echo "<div>Code: " . $Orders['id_shopping'] . "</div>";
                echo "<div>Shopping date: " . $Orders['shopping_date'] . "</div>";
                echo "<div>Status: " . $Orders['status'] . "</div>";
                echo "<div>Total price: " . $Orders['total_price'] . "</div>";
                echo "<div> <button class='btn-open-popup' data-popup-target='#popup-" . $id . "'>Show order</button></div>";
                echo "<div> <a href='index.php?controller=Orders&action=ticket&ticket=". $Orders['id_shopping'] ."'> <button id='btn-open-popup'>Download bill</button> </a></div>";
                echo "</div>";
                
                echo "<dialog class='popup' id='popup-" . $id . "'>";
                        echo "<h1>Order details</h1>";
                        echo"<div id='popup-div'>";
                                echo "<div><b>Product</b></div>";
                                echo "<div><b>Amount</b></div>";
                                echo "<div><b>Price</b></div>";
                            foreach ($myOrdersDetailsArray[$id] as $orderDetail) {
                                echo "<div>".$orderDetail['product']."</div>";
                                echo "<div>".$orderDetail['amount']."</div>";
                                echo "<div>".$orderDetail['total_price']."€</div>";
                            
                            }
                        echo"</div>";
                        echo "<button class='btn-close-popup'>Close</button>";
                echo "</dialog>";
            }
        ?>
    </div>
</div>
<script src='js/profile.js'></script>
<script src='js/deleteLocalStorage.js'></script>