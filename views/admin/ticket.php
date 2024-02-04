<div id="containerTicket">
    <div id="headerTicket">
        <div id="headerLeft">
            <h1>Order <?php echo $id_shopping;?> bill</h1>
            <p><?php echo $company->getName();?></p>
            <p><?php echo $company->getCif();?></p>
            <p><?php echo $company->getAddress();?></p>
        </div>
        <div id="headerRight">
            <img src="sources/web/logo.png" alt="logo" id="logoPhoto">
        </div>
    </div>
    <div id="contentTicket">
        
    </div>
    <div id="footerTicket">
        <button>Download PDF</button>
    </div>
    
</div>