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

function addAndCart($return) {
    let inputAmount = document.getElementById('amountParagraph');
    let amount = inputAmount.value;

    let url = window.location.href;
    var params = new URLSearchParams(new URL(url).search);
    var productCode = params.get('productCode');
    if($return == 1) {
        window.location.href = "index.php?controller=Orders&action=addAndCart&amount="+amount+"&product="+productCode+"&return=1";
    } else {
        window.location.href = "index.php?controller=Orders&action=addAndCart&amount="+amount+"&product="+productCode;
    } 
}

