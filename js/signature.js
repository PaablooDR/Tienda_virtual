document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('signatureCanvas');
    var context = canvas.getContext('2d');
    var save = document.getElementById('saveSignature');
    var clear = document.getElementById('cleanSignature');

    var drawing = false;

    canvas.addEventListener('mousedown', function (e) {
        drawing = true;
        draw(e);
    });

    canvas.addEventListener('mousemove', function (e) {
        if (drawing) draw(e);
    });

    canvas.addEventListener('mouseup', function () {
        drawing = false;
        context.beginPath();
    });

    function draw(e) {
        context.lineWidth = 2;
        context.lineCap = 'round';
        context.lineTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop);
    }

    save.addEventListener('click', function() {
        var imageData = canvas.toDataURL();

        // Enviar la imagen al servidor (usando un formulario)
        var form = new FormData();
        form.append('signature', imageData);

        fetch('index.php?controller=Admin&action=saveSignature', {
            method: 'POST',
            body: form
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
        context.clearRect(0, 0, canvas.width, canvas.height);
    });

    clear.addEventListener('click', function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    });
});