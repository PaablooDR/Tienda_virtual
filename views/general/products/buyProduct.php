<?php 
    if(empty($_GET['productCode'])){
        echo '<meta http-equiv="refresh" content="0;url=index.php?controller=Product&action=products">';
    } else {
        foreach($product as $productInfo){
?>
        <div id="buyProduct" style="background-image: url('sources/web/salon1.jpg');">
            <div id="productContainer">
                <img id="productImage" src="<?php echo $productInfo['photo'];?>">
                <div id="productDetails">
                    <div id="productInfo">
                        <h2><?php echo $productInfo['name'];?></h2>
                        <p><?php echo $productInfo['description'];?></p>
                        <p><?php echo $productInfo['price'];?> €</p>
                        <div id="buttons">
                            <button id="purchaseProduct">Purchase</button>
                            <div id="iconContainer">
                                <img id="productIcon" src="sources/web/addToCart.png">
                            </div>
                        </div>
                        <div id="drawerOptions">
                            <button class="openDrawer" data-drawer="drawerOption1">More info</button>
                            <button class="openDrawer" data-drawer="drawerOption2">Shipping info</button>
                            <button class="openDrawer" data-drawer="drawerOption3">Easy mount</button>
                        </div>
                        <div id="menu">
                            <div class="drawer" id="drawerOption1">
                                <div class="headerDrawer">
                                    <button class="closeDrawer">&#10006;</button>
                                    <h3>About this poster</h3>
                                </div>
                                <div id="drawerInfo1">
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Category</div>
                                        <div class="drawer-element-info"></div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Material</div>
                                        <div class="drawer-element-info">stainless steel</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Size</div>
                                        <div class="drawer-element-info">45 cm / 32 cm</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Thickness</div>
                                        <div class="drawer-element-info">3,50mm</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Weight</div>
                                        <div class="drawer-element-info">0,70kg</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Mounting</div>
                                        <div class="drawer-element-info">Magnet(no tools)</div>
                                    </div>  
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Included in the package</div>
                                        <div class="drawer-element-info">1 metal poster (45 cm / 32 cm), 1 protective leaf, 1 magnet</div>
                                    </div>
                                </div>
                            </div>
                            <div class="drawer" id="drawerOption2">
                                <div class="headerDrawer">
                                    <button class="closeDrawer">&#10006;</button>
                                    <h3>Shipping and a 100 days return</h3>
                                </div>
                                <div id="drawerInfo2">
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Time</div>
                                        <div class="drawer-element-info">Expected delivery time is 3-5 business days from placing your order.</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Returns</div>
                                        <div class="drawer-element-info">You may return a Displate within 100 calendar days of delivery and you will receive 100% refund (Displate needs to be sent at the customer's cost).</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="drawer-element-title">Gift-ready packaging</div>
                                        <div class="drawer-element-info">Displates arrive in a stylish, eco-friendly box that’s packed with goodies!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="drawer" id="drawerOption3">
                                <div class="headerDrawer">
                                    <button class="closeDrawer">&#10006;</button>
                                    <h3>Easy mounting in 3 steps</h3>
                                </div>
                                <div id="drawerInfo3">
                                    <div class="drawer-element">
                                        <div class="gif"><img src="sources/mounting_system-01.gif" alt="GIF"></div>
                                        <div class="drawer-element-title">Stick the leaf</div>
                                        <div class="drawer-element-info">Clean the wall using the included wipe. Once it's completely dry, stick the Protective Leaf and press around to remove air bubbles.</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="gif"><img src="sources/mounting_system-02.gif" alt="GIF"></div>
                                        <div class="drawer-element-title">Place the magnet</div>
                                        <div class="drawer-element-info">Peel off the foil and stick the magnet in a designated spot on the Protective Leaf. Press it firmly for at least 5 seconds to ensure a tight fit.</div>
                                    </div>
                                    <div class="drawer-element">
                                        <div class="gif"><img src="sources/mounting_system-03.gif" alt="GIF"></div>
                                        <div class="drawer-element-title">Hang your Displate</div>
                                        <div class="drawer-element-info">Position it any way you want and display yourself! You can swap it for another Displate in seconds and hang it using the same magnet.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
?>