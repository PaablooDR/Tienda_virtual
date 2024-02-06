document.addEventListener("DOMContentLoaded", function () {

    // Obtén el elemento canvas y su contexto 2D
    var canvas = document.getElementById("graficaEstadisticas");
    var ctx = canvas.getContext("2d");

    // Obtener datos desde el atributo de datos HTML
    var datos = JSON.parse(document.getElementById("datosPHP").textContent);
    var productos = JSON.parse(document.getElementById("productosPHP").textContent);
   
    // Configuración de la gráfica
    var alturaBarra = 30;
    var espacioEntreBarras = 20;
    var anchoMaximo = 150;
    var marginLeft = 100; // Margen a la izquierda para los nombres de los productos

    // Obtener datos desde el atributo de datos HTML
    var datos = JSON.parse(document.getElementById("datosPHP").textContent);

    function dibujarGrafica() {
        
        // Limpia el canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Dibuja cada barra
        for (var i = 0; i < datos.length; i++) {
            var anchoBarra = (datos[i] / Math.max(...datos)) * anchoMaximo;
            var y = i * (alturaBarra + espacioEntreBarras);
            var x = marginLeft;

            ctx.fillStyle = "blue";
            ctx.fillRect(x, y, anchoBarra, alturaBarra);

            ctx.fillStyle = "white";
            ctx.textAlign = "left";
            ctx.textBaseline = "middle";
            ctx.font = "bold 12px Arial";
            ctx.fillText(datos[i], x + anchoBarra - 20, y + alturaBarra / 2);
            

            ctx.fillStyle = "black";
            // Dibuja los nombres de los productos a la izquierda de las barras
            ctx.fillText(productos[i], 0 , y + alturaBarra / 2);
        }
    }

    dibujarGrafica();
});