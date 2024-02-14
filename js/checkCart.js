document.addEventListener("DOMContentLoaded", function () { 
    async function sentCartToServer(cart, totalPrice) {
        return new Promise(function(resolve, reject) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=Orders&action=cart', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log(xhr.status);
                if (xhr.status >= 200 && xhr.status < 300) {
                    resolve(xhr.response);
                } else {
                    reject('Error when the cart was send');
                }
            };
            xhr.onerror = function() {
                reject('Connection error');
            };
            // Send the cart and the total price to php
            xhr.send('cart=' + encodeURIComponent(cart) + '&totalPrice=' + encodeURIComponent(totalPrice));
        });
    }
    
    // Obtain the cart and the total price from localStorage
    let cart = localStorage.getItem('cart');
    let totalPrice = localStorage.getItem('totalPrice');
    
    if (cart && totalPrice) {
        (async function() {
            try {
                await sentCartToServer(cart, totalPrice);
                console.log('Cart and toal price sent correctly');
                // When the cart and the total price are sent, both will be remove
                localStorage.removeItem('cart');
                localStorage.removeItem('totalPrice');
            } catch (error) {
                console.error(error);
            }
        })();
    } else {
        // If some of the steps fail 
        //window.location.href = 'index.php?controller=Product&action=principal';
    }
});
