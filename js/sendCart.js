document.addEventListener('DOMContentLoaded', function() {
    // Obtener datos del Local Storage
    var datos = localStorage.getItem('cart');

    var xhr = new XMLHttpRequest();
    var url = './controllers/CartController.php'
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'appliaction/json');
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    }
    var datosJSON = JSON.stringify(datos);
    xhr.send(datosJSON);
});