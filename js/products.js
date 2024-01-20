$(document).ready(function () {
    $('.productContainer .imageOverlay').mousemove(function (event) {
        var container = $(this);

        var mouseX = event.pageX;
        var mouseY = event.pageY;

        var containerWidth = container.width();
        var containerHeight = container.height();

        var offsetX = mouseX - container.offset().left - containerWidth / 2;
        var offsetY = mouseY - container.offset().top - containerHeight / 2;

        // Calcular la inclinación
        var tiltX = (offsetY / containerHeight) * 30;
        var tiltY = (offsetX / containerWidth) * 30;

        container.find('.productImage').css({
            'transform': 'rotateX(' + tiltX + 'deg) rotateY(' + tiltY + 'deg)',
            'transition': 'transform 0.3s ease-out' // Agregado para una transición suave
        });

        container.css({
            'box-shadow': '0 10px 20px rgba(0, 0, 0, 0.2)',
            'transition': 'box-shadow 0.3s'
        });

        // Puedes agregar lógica adicional aquí para identificar el producto y realizar acciones específicas
    });

    $('.productContainer .imageOverlay').mouseleave(function () {
        var container = $(this);
        container.find('.productImage').css({
            'transform': 'rotateX(0deg) rotateY(0deg)',
            'transition': 'transform 0.3s ease-out'
        });
        container.css({
            'box-shadow': 'none',
            'transition': 'box-shadow 0.3s'
        });
    });

    $('.productContainer .iconContainer').mouseenter(function () {
        var container = $(this).closest('.productContainer');
        container.find('.productImage').css({
            'transform': 'rotateX(0deg) rotateY(0deg)',
            'transition': 'transform 0.3s ease-out'
        });
        container.css({
            'box-shadow': 'none',
            'transition': 'box-shadow 0.3s'
        });
    });
});
