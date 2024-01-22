<?php 
    if(empty($_GET['productCode'])){
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    }else{
        foreach($product as $productInfo){
?>
        <div id="buyProduct">
            <div id="productContainer">
                <img id="productImage" src="<?php echo $productInfo['photo'];?>">
            </div>
        </div>
<?php
        }
    }
?>