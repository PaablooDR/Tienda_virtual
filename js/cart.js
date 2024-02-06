document.addEventListener('DOMContentLoaded', function() {

    const urlParams = new URLSearchParams(window.location.search);
    // Obtener referencia al botón
    const addToCartButton = document.getElementById('addToCartLink');
    // Conseguir el precio del producto
    const productPriceElement = document.getElementById('productPrice');
    const productPrice = parseFloat(productPriceElement.innerText);
    // Conseguir el id donde esta la cantidad del producto
    
    console.log(productAmount);
    // Conseguir el codigo del producto 
    const productId = urlParams.get('productCode');

    // Función para añadir un producto al carrito y guardar en localStorage
    function addToCart() {
        //Conseguir la cantidad de productos que ha elegido el usuario
        const productAmountElement = document.getElementById('amountParagraph');
        const productAmount = parseInt(productAmountElement.value, 10);
        // Conseguir el max stock para preguntar
        const maxStock = parseInt(productAmountElement.getAttribute('max-stock'), 10);
        // Obtener el carrito actual del localStorage (si existe)
        const existingCart = JSON.parse(localStorage.getItem('cart')) || [];
        // Verificar si el producto ya está en el carrito
        const existingProductIndex = existingCart.findIndex(item => item.productId === productId);

        if (existingProductIndex !== -1) {
            const newProductAmount = existingCart[existingProductIndex].productAmount + productAmount;

            if (newProductAmount <= maxStock) {
                // Si no supera el stock máximo, actualizar la cantidad y el precio total
                existingCart[existingProductIndex].productAmount = newProductAmount;
                existingCart[existingProductIndex].totalPrice += productAmount * productPrice;
            } else {
                // Si supera el stock máximo, mostrar un alert y no agregar al carrito
                alert('Max stock reached');
                return; // Detener la ejecución si la cantidad supera el stock máximo
            }
        } else {
            // Si el producto no está en el carrito, agregarlo
            existingCart.push({
                productId,
                productAmount,
                productPrice,
                totalPrice: productAmount * productPrice
            });
        }

        // Guardar el carrito actualizado en el localStorage
        localStorage.setItem('cart', JSON.stringify(existingCart));

        // Imprimir el carrito actual
        console.log(JSON.parse(localStorage.getItem('cart')));
    }
    // Vincular la función addToCart al clic en el botón
    addToCartButton.addEventListener('click', addToCart);
});