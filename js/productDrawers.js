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