<div id="cartContainer">
    <div id="order-container">
        <h1>Your cart</h1>
        <div id="cartInfo">
        <?php
            foreach($cartInfo as $productInfo){
        ?>
            <div class="product-container" id="container">
                <img src='<?php echo $productInfo['photo'];?>' class='productImg' alt='<?php echo $productInfo['product_name'];?>' >

                <div class="product-details">
                    <p class="product-name"><?php echo $productInfo['product_name'];?></p>
                    <p class="product-price"><?php echo $productInfo['product_price'];?> $</p>
                    
                    <div class="quantity-controls">
                        <button class="decrease-btn" data-product-id="<?php echo $productInfo['product'];?>">-</button>
                        <input type="text" id='<?php echo $productInfo['product'];?>' value='<?php echo $productInfo['amount'];?>' min='1' max='<?php echo $productInfo['stock'];?>'/>
                        <button class="increase-btn" data-product-id="<?php echo $productInfo['product'];?>">+</button>
                    </div>

                    <p class="total-price">Total price: <span id='totalPrice<?php echo $productInfo['product'];?>'><?php echo $productInfo['detail_total_price'];?></span> $</p>
                </div>

                <button class="delete-btn" data-product-id="<?php echo $productInfo['product'];?>">X</button>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
    <div id="order-info">
        <div id="cartDetails">
            <h2>Cart Details</h2>
            <p>Total price: <span id="totalCartPrice">0.00 $</span></p>
            <button id="buyButton"><a href="index.php?controller=Orders&action=payment">Purchase</a></button>
        </div>
    </div>
</div>