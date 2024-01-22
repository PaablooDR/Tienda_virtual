<?php 
    if(empty($_GET['productCode'])){
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    } else {
        foreach($product as $productInfo){
?>
        <div id="buyProduct" style="background-image: url('sources/web/salon1.jpg');">
            <div id="productContainer">
                <img id="productImage" src="<?php echo $productInfo['photo'];?>">
                <div id="productContainer">
                    <div id="productInfo">
                        <h2><?php echo $productInfo['name'];?></h2>
                        <p><?php echo $productInfo['description'];?></p>
                    </div>
                    
                </div>
            </div>
        </div>
<?php
        }
    }
?>