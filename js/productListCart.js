
document.addEventListener("DOMContentLoaded", function() {
    createCartContainer();
    updateTotalPriceAllProducts();
});
function createCartContainer(){
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];

    var cartInfo = document.getElementById('cartInfo');

    var buyBtn = document.getElementById('buyButton');
    var buyLink = document.getElementById('purchaseLink');

    if(productsLocalStorage.length === 0){
        console.log('nothing in the cart');
        buyLink.style.pointerEvents = 'none';
        buyBtn.disabled = true;
    }else{
        productsLocalStorage.forEach(function(product) {
            var productDiv = document.createElement('div');
            productDiv.classList.add('product-container');
            productDiv.id = 'container' + product.productId;
            productDiv.innerHTML = `    
                <img src='${product.productImg}' class='productImg' alt='${product.productName}' >

                <div class="product-details">
                    <p class="product-name">${product.productName}</p>
                    <p class="product-price">${product.productPrice} $</p>
                    
                    <div class="quantity-controls">
                        <button class="decrease-btn" data-product-id="${product.productId}">-</button>
                        <input type="text" id='${product.productId}' value='${product.productAmount}' min='1' max='${product.maxStock}'/>
                        <button class="increase-btn" data-product-id="${product.productId}">+</button>
                    </div>

                    <p class="total-price">Total price: <span id='totalPrice${product.productId}'>${product.totalPrice}</span> $</p>
                </div>

                <button class="delete-btn" data-product-id="${product.productId}">X</button>
            `;

            var deleteButton = productDiv.querySelector('.delete-btn');
            deleteButton.addEventListener('click', function(){
                productDiv.classList.add('fade-out-slide-up');
                // Espera a que termine la animación antes de eliminar el elemento
                setTimeout(function() {
                    deleteProductAndUpdateUI(product.productId);
                }, 1000);
            });

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
                this.value = this.value.replace(/[^\d]/g, ''); // Elimina caracteres no numéricos
            });
            input.addEventListener('blur', function() {
                handleBlur(input);
            }); 
            input.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    handleBlur(input);
                    event.preventDefault();
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
            var productDiv = document.getElementById('container' + productId);
            if (productDiv) {
                // Establece la propiedad display para ocultar el elemento
                productDiv.style.display = 'none';
                productDiv.classList.add('fade-out-slide-up');

                // Espera a que termine la animación antes de eliminar el elemento
                setTimeout(function() {
                    productDiv.remove();
                    updateTotalPriceAllProducts();

                    var remainingProducts = JSON.parse(localStorage.getItem('cart')) || [];
                    if (remainingProducts.length === 0) {
                        var buyBtn = document.getElementById('buyButton');
                        var buyLink = document.getElementById('purchaseLink');
                        buyLink.style.pointerEvents = 'none';
                        buyBtn.disabled = true;
                        console.log('no products');
                    }
                }, 0.4); 
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

    updateTotalPriceAllProducts();
}

function handleQuantityChange(productId, change) {
    var product = getProductById(productId);

    if (product) { // Asegúrate de que el producto exista
        var currentAmount = parseInt(product.productAmount);
        var input = document.getElementById(`${product.productId}`);

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

        // Validaciones para asegurarse de que el valor sea un número y está en el rango correcto
        if (!isNaN(currentAmount) && currentAmount >= 1 && currentAmount <= product.maxStock) {
            // Actualizar el producto solo si la cantidad ha cambiado
            if (currentAmount !== product.productAmount) {
                product.productAmount = currentAmount;
                updateProductInLocalStorage(product);
                updateButtonState(product);
                updateTotalPrice(product);
            }
        } else {
            // Restaurar el valor anterior si no es válido o es 0
            input.value = product.productAmount || 1;
        }
    }
}
function updateTotalPriceAllProducts() {
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];
    var totalPrice = productsLocalStorage.reduce(function(acc, product) {
        return acc + product.totalPrice;
    }, 0);

    document.getElementById('totalCartPrice').textContent = totalPrice.toFixed(2) + '$';
}
