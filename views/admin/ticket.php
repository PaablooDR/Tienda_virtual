<div id="containerTicket">
    <h1>Order <?php echo $id_shopping;?> bill</h1>
    <div id="headerTicket">
        <div id="headerLeft">
            <p><?php echo $company->getName();?></p>
            <p><?php echo $company->getCif();?></p>
            <p><?php echo $company->getAddress();?></p>
        </div>
        <div id="headerRight">
            <img src="sources/web/logo.png" alt="logo" id="logoPhoto">
        </div>
    </div>
    <div id="contentTicket">
        <h4>Client information:</h4>
        <div id="infoClient">
            <div>
                <p>DNI: <?php echo $client->getDni(); ?></p>
                <p>Name: <?php echo $client->getName(); ?></p>
                <p>Surname: <?php echo $client->getSurname(); ?></p>
            </div>
            <div>
                <p>Email: <?php echo $client->getEmail(); ?></p>
                <p>Address: <?php echo $client->getAddress(); ?></p>
            </div>
        </div>
        <div id="prices">
            <div id="headerPrices">
                <div>Code product</div>
                <div>Price per product</div>
                <div>Amount</div>
                <div>Import</div>
            </div>
            <?php
            foreach($dataOrderDetails as $detail) {
            ?>
            <div class="contentPrices">
                <div><?php echo $detail['product'] ?></div>
                <div><?php echo $detail['price_per_product'] ?></div>
                <div><?php echo $detail['amount'] ?></div>
                <div><?php echo $detail['total_price'] ?></div>
            </div>
            <?php
            }
            ?>
            <div id="footerPrices">
                <div>Total price: </div>
                <div><?php echo $order->getPrecioTotalPedido() ?></div>
            </div>
        </div>
        <div id="sign">
            <p>Sign:</p>
            <img src="sources/signature/signature.png" alt="sign" id="signPhoto">
        </div>
    </div>
    <div id="footerTicket">
        <button>Download PDF</button>
    </div>
    
</div>