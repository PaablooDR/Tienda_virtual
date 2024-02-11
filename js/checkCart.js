document.addEventListener("DOMContentLoaded", function () { 
    async function sentCartToServer(cart) {
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
            xhr.send('cart=' + encodeURIComponent(cart));
        });
    }
    
    // Obtain the cart from de localStorage
    let cart = localStorage.getItem('cart');
    console.log(cart);
    
    if (cart) {
        (async function() {
            try {
                await sentCartToServer(cart);
                console.log('cart sent correctly');
                // When the cart is shipped, the cart in localstroge is deleted
                localStorage.removeItem('cart');
                window.location.href = 'index.php?controller=Product&action=principal';
            } catch (error) {
                console.error(error);
            }
        })();
    } else {
        window.location.href = 'index.php?controller=Product&action=principal';
    }  
});