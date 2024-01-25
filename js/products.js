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
});
function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    var maxStock = parseInt(input.getAttribute('max-stock'), 10);

    if (isNaN(value) || value < 1) {
        value = 1;
    } else if (value >= maxStock) {
        value = maxStock;
    } else {
        value++;
    }

    input.value = value;
}

function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    var maxStock = parseInt(input.getAttribute('max-stock'), 10);

    if (isNaN(value) || value <= 1) {
        value = 1;
    } else {
        value--;
    }

    input.value = value;
}

function validateInput(input) {
    var value = parseInt(input.value, 10);
    var maxStock = parseInt(input.getAttribute('max-stock'), 10);

    if (isNaN(value) || value < 1) {
        input.value = 1;
    } else if (value > maxStock) {
        input.value = maxStock;
    }
}

function handleKeyPress(event, input) {
    var key = event.key;
    
    // Permitir números, tecla de retroceso y Enter
    if (!/[0-9\n]/.test(key) && key !== 'Backspace') {
        event.preventDefault();
    }

    if (key === 'Backspace') {
        var selectionStart = input.selectionStart;
        var selectionEnd = input.selectionEnd;
    
        console.log(key);
        console.log(selectionStart);
        console.log(selectionEnd);
    
        // Verificar que haya algo a la izquierda del cursor
        if (selectionStart > 0 && selectionStart === selectionEnd) {
            // Eliminar el carácter a la izquierda del cursor
            var value = input.value;
            input.value = value.slice(0, selectionStart - 1) + value.slice(selectionStart);
            
            // Colocar el cursor en la posición correcta después de eliminar el carácter
            input.setSelectionRange(selectionStart - 1, selectionStart - 1);
        } else {
            // Si hay una selección, eliminar la selección
            input.setRangeText('', selectionStart, selectionEnd, 'end');
        }
    
        // Prevenir el comportamiento predeterminado del evento keypress
        event.preventDefault();
    }
    
    // Si se presiona Enter, realiza la validación
    if (key === 'Enter') {
        validateInput(input);
        event.preventDefault();
    }
    
}



