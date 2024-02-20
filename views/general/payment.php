<div id="payment">
    <div id="titleAdmin">
        <img src="sources/web/paypal.png">
        <h1>Payment</h1>
    </div>
    <div id="purchaseInformation">
        <h3>Purchase information</h3>
        <p>Import: </p>
        <p>Comerce: PlateArt</p>
        <p>Order: <?php echo $order; ?> </p>
        <p>Date: <?php echo $today; ?> </p>
    </div>
    <div id="paypal">
        <h3>Paypal account</h3>
        <form action="index.php?controller=Orders&action=orderPaid&order=<?php echo $order; ?>" autocomplete="off" method="post" enctype="multipart/form-data">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" name="send" value="Accept" aria-label="Pay">
        </form>
    </div>
    
</div>