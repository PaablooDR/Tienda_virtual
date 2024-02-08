function createCartContainer(){
    var productsLocalStorage = JSON.parse(localStorage.getItem('cart')) || [];

    var cartInfo = document.getElementById('cartInfo');

    productsLocalStorage.forEach(function(product) {
        var productDiv = document.createElement('div');
        productDiv.classList.add('product')

        productDiv.innerHTML = `
            <p>Product: ${product.productName}</p>
            <p>Amount: ${product.productAmount}</p>
            <p>Price: ${product.productPrice}</p>
            <p>Total price: ${product.totalPrice}</p>
        `;

        var productImage = document.createElement('img');
        productImage.src = product.productImg;
        productImage.alt = product.productName;
        productImage.classList.add('productImg');

        productDiv.appendChild(productImage)
        cartInfo.appendChild(productDiv);
    });


    
}