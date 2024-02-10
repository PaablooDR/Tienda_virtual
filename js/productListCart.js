
document.addEventListener("DOMContentLoaded", function() {
    // Esta función se ejecutará cuando la página esté completamente cargada
    createCartContainer();
});
function createCartContainer(){
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];

    var cartInfo = document.getElementById('cartInfo');

    if(productsLocalStorage.length === 0){
        console.log('nothing in the cart');
    }else{
        productsLocalStorage.forEach(function(product) {
            var productDiv = document.createElement('div');
            productDiv.classList.add('product');
            productDiv.id = product.productId;

            productDiv.innerHTML = `    
                <img src='${product.productImg}' class='productImg' alt='${product.productName}' >
                <p>Product: ${product.productName}</p>
                <p>Price: ${product.productPrice}</p>
                <p>Total price: <span id='totalPrice${product.productId}'>${product.totalPrice}</span></p>
                <div class="quantity-controls">
                    <button class="decrease-btn" data-product-id="${product.productId}">-</button>
                    <input type="number" id='${product.productId}' value='${product.productAmount}' min='1' max='${product.maxStock}'/>
                    <button class="increase-btn" data-product-id="${product.productId}">+</button>
                </div>
            `;

            var deleteButton = document.createElement('button');
            deleteButton.innerText = "x";
            deleteButton.addEventListener('click', function(){
                productDiv.classList.add('fade-out-slide-up');
                // Espera a que termine la animación antes de eliminar el elemento
                setTimeout(function() {
                    deleteProductAndUpdateUI(product.productId);
                }, 1000);
            });

            productDiv.appendChild(deleteButton);
            cartInfo.appendChild(productDiv);
            updateButtonState(product);
        });

        document.querySelectorAll('.increase-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                handleQuantityChange(button.dataset.productId, 1);
            });
        });
    
        document.querySelectorAll('.decrease-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                handleQuantityChange(button.dataset.productId, -1);
            });
        });
    
        // Asignar eventos al cambio de valor en los inputs
        document.querySelectorAll('.quantity-controls input').forEach(function(input) {
            input.addEventListener('input', function() {
                handleQuantityChange(input.dataset.productId, 0); // 0 para indicar que no hay cambio, solo se valida y ajusta el valor
            });
            input.addEventListener('blur', function() {
                handleBlur(input);
            }); 
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    handleBlur(input);
                }
            });
        });
    }
}
function deleteProduct(productId){
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];
    var updatedProducts = productsLocalStorage.filter(function(product){
        return product.productId !== productId;
    });

    localStorage.setItem('cart', JSON.stringify(updatedProducts));

    return Promise.resolve();
}

function deleteProductAndUpdateUI(productId) {
    deleteProduct(productId)
        .then(function() {
            var productDiv = document.getElementById(productId);
            if (productDiv) {
                // Establece la propiedad display para ocultar el elemento
                productDiv.style.display = 'none';
                productDiv.classList.add('fade-out-slide-up');

                // Espera a que termine la animación antes de eliminar el elemento
                setTimeout(function() {
                    productDiv.remove();
                }, 0.4); // Ajusta el tiempo de espera según la duración de tu animación
            }
        })
        .catch(function(error) {
            console.error('Error al eliminar el producto:', error);
        });
}


function updateProductInLocalStorage(updatedProduct) {
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];
    var updatedProducts = productsLocalStorage.map(function(product) {
        if (product.productId === updatedProduct.productId) {
            updatedProduct.totalPrice = updatedProduct.productAmount * product.productPrice;
            return updatedProduct;
        }
        return product;
    });
    localStorage.setItem('cart', JSON.stringify(updatedProducts));

    console.log(JSON.parse(localStorage.getItem('cart')));
}

function handleQuantityChange(productId, change) {
    var product = getProductById(productId);

    if (product) { // Asegúrate de que el producto exista
        var currentAmount = parseInt(product.productAmount);
        var input = document.getElementById(productId);

        if (!isNaN(currentAmount)) { // Asegúrate de que currentAmount sea un número
            var newAmount = currentAmount + change;

            // Ajusta el valor mínimo y máximo
            newAmount = Math.max(1, Math.min(newAmount, product.maxStock));

            input.value = newAmount;
            // Actualiza la cantidad solo si ha cambiado
            if (newAmount !== currentAmount) {
                product.productAmount = newAmount;
                updateProductInLocalStorage(product);
                updateButtonState(product);
                updateTotalPrice(product);
            }
        }
    }
}
function updateTotalPrice(product){
    var priceElement = document.getElementById(`totalPrice${product.productId}`);
    priceElement.textContent = product.totalPrice.toFixed(2);
}

function updateButtonState(product) {
    var increaseButton = document.querySelector(`.increase-btn[data-product-id="${product.productId}"]`);
    var decreaseButton = document.querySelector(`.decrease-btn[data-product-id="${product.productId}"]`);

    // Desactiva el botón de aumento cuando se alcanza el límite de stock
    if (product.productAmount >= product.maxStock) {
        increaseButton.disabled = true;
    } else {
        increaseButton.disabled = false;
    }

    // Desactiva el botón de disminución cuando la cantidad del producto es 1
    if (product.productAmount === 1) {
        decreaseButton.disabled = true;
    } else {
        decreaseButton.disabled = false;
    }
}
function getProductById(productId) {
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];
    return productsLocalStorage.find(function(product) {
        return product.productId === productId;
    });
}
function handleBlur(input) {
    var productId = input.id;
    var product = getProductById(productId);

    if (product) {
        var currentAmount = parseInt(input.value);
        if (isNaN(currentAmount) || currentAmount < 1) {
            // Si el valor no es un número o es menor que 1, establecer en 1
            input.value = 1;
            currentAmount = 1;
        } else if (currentAmount > product.maxStock) {
            // Si el valor es mayor que el stock máximo, establecer en el máximo stock
            input.value = product.maxStock;
            currentAmount = product.maxStock;
        }

        // Actualizar el producto solo si la cantidad ha cambiado
        if (currentAmount !== product.productAmount) {
            product.productAmount = currentAmount;
            updateProductInLocalStorage(product);
            updateButtonState(product);
            updateTotalPrice(product);
        }
    }
}
