document.addEventListener('DOMContentLoaded', function() {
    // Conseguir los parametros necesarios por URL
    const urlParams = new URLSearchParams(window.location.search);
    // ID del boton de añadir al carrito
    const addToCartButton = document.getElementById('addToCartLink');
    // Conseguir el precio del producto
    const productPriceElement = document.getElementById('productPrice');
    const productPrice = parseFloat(productPriceElement.innerText);
    // Conseguir el ID del producto
    const productId = urlParams.get('productCode');

    // Funcion para añadir productos al carrito (en localsotrage)
    function addToCart() {
        // Promesa para añadir al carrito, si da reject, es porque llega al maximo de stock
        return new Promise((resolve, reject) => {
            // Conseguir la cantidad del producto
            const productAmountElement = document.getElementById('amountParagraph');
            const productAmount = parseInt(productAmountElement.value, 10);
            // Conseguir el stock maximo del producto
            const maxStock = parseInt(productAmountElement.getAttribute('max-stock'), 10);
            // Calcular el precio total
            const totalPrice = parseFloat((productAmount * productPrice).toFixed(2));
            // Revisar si ya hay un carrito en el local storage
            const existingCart = JSON.parse(localStorage.getItem('cart')) || [];
            // Obtener si el producto elegido ya lo tenia en el carrito 
            const existingProductIndex = existingCart.findIndex(item => item.productId === productId);
            //Pregunta si esta o no el producto en el carrito
            if (existingProductIndex !== -1) {
                // Suma la cantidad que ya tenia en el carrito con la que ha elegido nueva del mismo producto
                const newProductAmount = existingCart[existingProductIndex].productAmount + productAmount;
                // Pregunta si la cantidad nueva es mas grande o igual al stock maximo
                if (newProductAmount <= maxStock) {
                    //Si no es mas grande que el stock maximo actualiza la informacion del carrito y la promesa se resuelve
                    existingCart[existingProductIndex].productAmount = newProductAmount;
                    existingCart[existingProductIndex].totalPrice += productAmount * productPrice;
                    resolve(existingCart);
                } else {
                    // La promesa rejectea porque la cantidad total es mas grande que el stock maximo
                    reject('Max stock reached');
                }
            } else {
                // Se añade el nuevo producto con su informacion al local storage
                existingCart.push({
                    productId,
                    productAmount,
                    productPrice,
                    totalPrice
                });
                // La promesa se resuelve
                resolve(existingCart);
            }
        });
    }
    // Funcion para actualizar el precio total de todo el carrito
    function updateTotalPrice(cart) {
        // Suma todos los precios totales de todos los productos del carrito
        const totalGeneral = cart.reduce((total, item) => total + item.totalPrice, 0);
        const roundedTotal = parseFloat(totalGeneral.toFixed(2));
        // Actualiza el precio total del carrito
        localStorage.setItem('totalPrice', roundedTotal);
        console.log('Total Price:', roundedTotal);
    }
    // Event listener para el boton de añadir al carrito
    addToCartButton.addEventListener('click', () => {
        addToCart()
            .then(updatedCart => {
                localStorage.setItem('cart', JSON.stringify(updatedCart));
                updateTotalPrice(updatedCart);
                console.log(JSON.parse(localStorage.getItem('cart')));
            })
            .catch(error => {
                alert(error);
            });
    });
});