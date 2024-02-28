
document.addEventListener('DOMContentLoaded', function () {
    var quantityInputs = document.querySelectorAll('.quantity-input');
    var deleteButtons = document.querySelectorAll('.delete-btn');

    quantityInputs.forEach(function(input) {
        var productId = input.id;
        var decreaseBtn = document.querySelector('.decrease-btn[data-product-id="' + productId + '"]');
        var increaseBtn = document.querySelector('.increase-btn[data-product-id="' + productId + '"]');
        var totalPriceSpan = document.getElementById('totalPrice' + productId);
        var maxStock = parseInt(input.getAttribute('max'));
        var currentValue = parseInt(input.value);
        let shoppingIdDiv = document.getElementById(productId);
        const shoppingId = shoppingIdDiv.getAttribute('shopping-id-data');

        decreaseBtn.disabled = currentValue <= 1;
        increaseBtn.disabled = currentValue >= maxStock;

        // Manejar la desactivación de los botones según el stock
        input.addEventListener('input', function () {
            var currentValue = parseInt(input.value);
            
            // Verificar si el valor es un número válido y dentro del rango
            if (isNaN(currentValue) || currentValue < 1) {
                currentValue = 1;
            } else if (currentValue > maxStock) {
                currentValue = maxStock;
            }

            input.value = currentValue;
            decreaseBtn.disabled = currentValue <= 1;
            increaseBtn.disabled = currentValue >= maxStock;

            updateTotalPrice(productId, currentValue);
            updateQuantity(productId, input.value);
            updateTotalPriceShopping(shoppingId);
            updateCartTotalPrice();
        });
        input.addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
            if (key < 48 || key > 57) {
                e.preventDefault();
            }
        });
        function updateTotalPrice(productId, newQuantity) {
            var productPrice = parseFloat(document.getElementById('productPrice' + productId).textContent);
            var newTotalPrice = productPrice * newQuantity;
            // Actualizar el elemento HTML que muestra el total_price
            totalPriceSpan.textContent = newTotalPrice.toFixed(2);
        }

        // Manejar el evento de hacer clic en el botón de disminuir
        decreaseBtn.addEventListener('click', function () {
            var currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
                input.dispatchEvent(new Event('input'));
                updateQuantity(productId, input.value);
                updateTotalPriceShopping(shoppingId);
            }
        });

        // Manejar el evento de hacer clic en el botón de aumentar
        increaseBtn.addEventListener('click', function () {
            var currentValue = parseInt(input.value);
            var maxStock = parseInt(input.getAttribute('max'));
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
                input.dispatchEvent(new Event('input'));
                updateQuantity(productId, input.value);
                updateTotalPriceShopping(shoppingId);
            }
        });
    });
    deleteButtons.forEach(function(deleteBtn) {
        let productId = deleteBtn.getAttribute('data-product-id');
        let shoppingIdDiv = document.getElementById('productContainer' + productId);
        const shoppingId = shoppingIdDiv.getAttribute('shopping-id-data');
        deleteBtn.addEventListener('click', function() {
            var productId = deleteBtn.getAttribute('data-product-id');
            var productContainer = document.getElementById('productContainer' + productId);

            productContainer.classList.add('fade-out-slide-up');
            console.log(shoppingId);
            // Esperar a que termine la animación antes de eliminar el producto
            setTimeout(function() {
                // Eliminar el producto del DOM
                productContainer.parentNode.removeChild(productContainer);
                deleteProduct(productId,shoppingId).then(function(response) {
                    // Manejar la respuesta si es necesario
                }).catch(function(error) {
                    console.error(error);
                });

                var remainingProducts = document.querySelectorAll('.product-container');
                console.log(remainingProducts);
                if (remainingProducts.length === 0) {
                    var buyButton = document.getElementById('buyButton');
                    var purchaseLink = document.getElementById('purchaseLink');

                    buyButton.disabled = true;
                    purchaseLink.style.pointerEvents = 'none';
                }
                
                updateCartTotalPrice();
                updateTotalPriceShopping(shoppingId);
            }, 500); 
        });
    });
    function updateQuantity(productId, newQuantity) {
        let shoppingIdDiv = document.getElementById('productContainer' + productId);
        let shoppingId = shoppingIdDiv.getAttribute('shopping-id-data');
        console.log(shoppingId,productId,newQuantity);
        return new Promise(function(resolve, reject) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=Orders&action=updateCartAmount', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log(xhr.status);
                if (xhr.status >= 200 && xhr.status < 300) {
                    resolve(xhr.response);
                } else {
                    reject('Error');
                }
            };
            xhr.onerror = function() {
                reject('Connection error');
            };
            // Send the cart and the total price to php
            xhr.send('productId=' + encodeURIComponent(productId) + '&newQuantity=' + encodeURIComponent(newQuantity) + '&shoppingId=' + encodeURIComponent(shoppingId));
        });
    }
    function updateTotalPriceShopping(shoppingId) {

        var totalPrice = calculateCartTotalPrice().toFixed(2);
        return new Promise(function(resolve, reject) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=Orders&action=updateShoppingPrice', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log(xhr.status);
                if (xhr.status >= 200 && xhr.status < 300) {
                    resolve(xhr.response);
                } else {
                    reject('Error');
                }
            };
            xhr.onerror = function() {
                reject('Connection error');
            };
            // Send the cart and the total price to php
            xhr.send('totalPrice=' + encodeURIComponent(totalPrice) + '&shoppingId=' + encodeURIComponent(shoppingId));
        });
    }
    function deleteProduct(productId,shoppingId) {
        return new Promise(function(resolve, reject) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?controller=Orders&action=deleteProductFromCart', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                console.log(xhr.status);
                if (xhr.status >= 200 && xhr.status < 300) {
                    resolve(xhr.response);
                } else {
                    reject('Error');
                }
            };
            xhr.onerror = function() {
                reject('Connection error');
            };
            // Send the cart and the total price to php
            xhr.send('productId=' + encodeURIComponent(productId) + '&shoppingId=' + encodeURIComponent(shoppingId));
        });
    }
    function updateCartTotalPrice() {
        var cartTotalPriceElement = document.getElementById('totalCartPrice');
        var newCartTotalPrice = calculateCartTotalPrice(); 
        cartTotalPriceElement.textContent = newCartTotalPrice.toFixed(2) + " $";
    }
    function calculateCartTotalPrice() {
        var totalPriceElements = document.querySelectorAll('.total-price span');
        var cartTotalPrice = 0;

        totalPriceElements.forEach(function(span) {
            cartTotalPrice += parseFloat(span.textContent);
        });

        return cartTotalPrice;
    }
});
