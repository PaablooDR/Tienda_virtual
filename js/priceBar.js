document.addEventListener('DOMContentLoaded', function () {
    var categorySelect = document.getElementById("categorySelect");

    categorySelect.addEventListener('change', function () {
        var selectedCategoryCode = categorySelect.value;
        updateURL('categoryCode', selectedCategoryCode);
    });
});

// Obtener el contenedor del slider
var priceRange = document.getElementById("priceRange");

// Obtener la URL actual
var url = new URL(window.location.href);

// Obtener los parámetros de la URL
var params = new URLSearchParams(url.search);

// Obtener el valor mínimo y máximo
var min = params.get('min');
var max = params.get('max');

// Funcion isset
function isset(variable) {
    return typeof variable !== 'undefined' && variable !== null;
}

// Inicializar el slider con noUiSlider
if(isset(min) && isset(max)){
    noUiSlider.create(priceRange, {
        start: [min, max], // Valores iniciales mínimo y máximo
        connect: true, // Conectar los puntos de control
        range: {
            'min': 0,
            'max': 100
        }
    });
}else{
    noUiSlider.create(priceRange, {
        start: [0, 100], // Valores iniciales mínimo y máximo
        connect: true, // Conectar los puntos de control
        range: {
            'min': 0,
            'max': 100
        }
    });
}

// Obtener los elementos de salida de los valores mínimo y máximo
var minValueOutput = document.getElementById("minValue");
var maxValueOutput = document.getElementById("maxValue");

// Escuchar el evento de cambio en el slider
priceRange.noUiSlider.on('update', function (values, handle) {
    if (handle === 0) {
        // Actualizar el valor mínimo en la URL
        updateURL('min', values[0]);
        minValueOutput.innerHTML = values[0] + "€";
    }
    if (handle === 1) {
        // Actualizar el valor máximo en la URL
        updateURL('max', values[1]);
        maxValueOutput.innerHTML = values[1] + "€";
    }
});

// Función para actualizar la URL con los valores del slider y el radio
function updateURL(param, value) {
    var url = new URL(window.location.href);
    url.searchParams.set(param, value);
    window.history.replaceState({}, '', url);
}

// Obtener todos los radios de orden
var orderRadios = document.querySelectorAll('input[name="order"]');

// Escuchar el evento de cambio en los radios de orden
orderRadios.forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Obtener el valor seleccionado
        var selectedValue = document.querySelector('input[name="order"]:checked').value;
        // Actualizar la URL con el valor seleccionado
        updateURL('order', selectedValue);
    });
});

var apply = document.getElementById("apply");
apply.addEventListener("click", function() {
    //Take the name of the file
    var ubicacionCompleta = window.location.href;
    var url = new URL(ubicacionCompleta);
    var nombreDeArchivo = url.pathname.substring(url.pathname.lastIndexOf('/') + 1) + url.search;
    window.location.href = nombreDeArchivo;
});