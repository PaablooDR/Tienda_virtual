$(document).ready(function(){
    $('.imageContainer').tilt({
        maxTilt: 15,
        transition: true,
        glare: true,
        maxGlare: .1,
    })
});

document.addEventListener("DOMContentLoaded", function() {
    const menu = document.getElementById("menu");
    const openDrawerButtons = document.querySelectorAll(".openDrawer");
    const closeDrawerButtons = document.querySelectorAll(".closeDrawer");

    openDrawerButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            const drawerId = button.getAttribute("data-drawer");
            const drawer = document.getElementById(drawerId);

            // Oculta todos los cajones antes de mostrar el seleccionado
            closeDrawers();
            
            menu.style.right = "0";
            drawer.style.display = "block";

            // Evita que el clic en el botón se propague al documento
            event.stopPropagation();
        });
    });

    closeDrawerButtons.forEach(button => {
        button.addEventListener("click", function() {
            menu.style.right = "-400px";
            closeDrawers();
        });
    });

    document.addEventListener("click", function() {
        menu.style.right = "-400px";
        closeDrawers();
    });

    // Evita que el clic dentro del menú cierre el menú
    menu.addEventListener("click", function(event) {
        event.stopPropagation();
    });

    function closeDrawers() {
        const drawers = document.querySelectorAll(".drawer");
        drawers.forEach(drawer => {
            drawer.style.display = "none";
        });
    }

    var amountParagraph = document.getElementById('amountParagraph');
    var sumButton = document.getElementById('sum');
    var restButton = document.getElementById('rest');
    var stockLimit = parseInt(amountParagraph.getAttribute('max-stock'), 10);

    // Event listener para el botón de sumar
    sumButton.addEventListener('click', function () {
        incrementAmount();
    });

    // Event listener para el botón de restar
    restButton.addEventListener('click', function () {
        decrementAmount();
    });

    // Event listener para el cambio en el contenido del párrafo
    amountParagraph.addEventListener('input', function () {
        updateAmount();
    });

    // Event listener para el cambio de foco del párrafo
    amountParagraph.addEventListener('blur', function () {
        updateAmount();
    });

    // Función para incrementar la cantidad
    function incrementAmount() {
        var currentAmount = parseAmount();
        if (!isNaN(currentAmount) && currentAmount < stockLimit) {
            currentAmount++;
            updateAmount(currentAmount);
        }
    }

    // Función para decrementar la cantidad
    function decrementAmount() {
        var currentAmount = parseAmount();
        if (!isNaN(currentAmount) && currentAmount > 1) {
            currentAmount--;
            updateAmount(currentAmount);
        }
    }

    // Función para actualizar la cantidad en el DOM
    function updateAmount(newAmount) {
        var clampedAmount = Math.min(stockLimit, Math.max(1, newAmount));
        amountParagraph.textContent = clampedAmount;
    }

    // Función para parsear la cantidad
    function parseAmount() {
        return parseFloat(amountParagraph.textContent) || 0;
    }
});


