<div id="payment">
    <div id="titleAdmin" class="titlePayment">
        <h1>Payment</h1>
    </div>
    <div id="paymentContainer">
        <div id="purchaseInformation">
            <h3>Purchase information</h3>
            <p>Import: <?php echo $totalPrice; ?> €</p>
            <p>Comerce: PlateArt</p>
            <p>Order: <?php echo $order; ?> </p>
            <p>Date: <?php echo $today; ?> </p>
        </div>
        <div id="paypal">
            <h3>Paypal account</h3>
            <form action="index.php?controller=Orders&action=orderPaid&order=<?php echo $order; ?>" autocomplete="off" method="post" enctype="multipart/form-data">
                <input type="text" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="send" value="Accept" id="paymentButton" aria-label="Pay">
            </form>
        </div>
    </div>
</div>