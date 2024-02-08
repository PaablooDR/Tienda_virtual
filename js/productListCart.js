function createCartContainer(){
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];

    var cartInfo = document.getElementById('cartInfo');

    productsLocalStorage.forEach(function(product) {
        var productDiv = document.createElement('div');
        productDiv.classList.add('product')

        productDiv.innerHTML = `
            <p>Product: ${product.productName}</p>
            <p>Amount: <span class='productAmount'>${product.productAmount}</span></p>
            <p>Price: ${product.productPrice}</p>
            <p>Total price: ${product.totalPrice}</p>
        `;

        var productImage = document.createElement('img');
        productImage.src = product.productImg;
        productImage.alt = product.productName;
        productImage.classList.add('productImg');

        var deleteButton = createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', function() {
            removeFromCart(product.productId);
            
            createCartContainer();
        });

        var increaseButton = document.createElement('button');
        increaseButton.textContent = '+';
        increaseButton.addEventListener('click', function(){
            updateProductAmount(product.productId,Math.max(0, product.productAmount + 1));

            createCartContainer();
        })

        var decreaseButton = document.createElement('button');
        decreaseButton.textContent = '-'; 
        decreaseButton.addEventListener('click', function() {
            updateProductAmount(product.productId,Math.max(0, product.productAmount - 1));

            createCartContainer();
        });

        
        productDiv.appendChild(productImage);
        productDiv.appendChild(deleteButton);
        productDiv.appendChild(increaseButton);
        productDiv.appendChild(decreaseButton);
        cartInfo.appendChild(productDiv);
    });
    function createButton(text,clickHandler) {
        var button = document.createElement('button');
        button.textContent = text;
        button.addEventListener('click', clickHandler);
        return button;
    }
    function deleteProduct(productId){
        var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];
        var updatedProducts = productsLocalStorage.filter(function(product){
            return product.productId !== productId;
        });

        localStorage.setItem('cart', JSON.stringify(updatedProducts));
    }

    function updateProductAmount(productId,newAmount){
        var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];

        var updatedProducts = productsLocalStorage.map(function(product){
            if(product.productId === productId){
                product.productAmount = newAmount;
                product.totalPrice = newAmount * productPrice;
            }
            return product;
        });
        localStorage.setItem('cart', JSON.stringify(updatedProducts));
    }
}