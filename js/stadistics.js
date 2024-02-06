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
    var anchoMaximo = 200;
    var marginLeft = 110; // Margen a la izquierda para los nombres de los productos
    var marginTop = 50; // Margen superior para la gráfica

    var colores = ["#64ADFF", "#FFA07A", "#FFB6C1", "#90EE90", "#FF837F"];

    function dibujarGrafica() {
        
        // Limpia el canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Dibuja cada barra
        for (var i = 0; i < datos.length; i++) {
            var anchoBarra = (datos[i] / Math.max(...datos)) * anchoMaximo;
            var y = i * (alturaBarra + espacioEntreBarras)+ marginTop;
            var x = marginLeft;

            ctx.fillStyle = colores[i % colores.length];
            ctx.fillRect(x, y, anchoBarra, alturaBarra);

            ctx.fillStyle = "white";
            ctx.textAlign = "left";
            ctx.textBaseline = "middle";
            ctx.font = "bold 12px Arial";
            ctx.fillText(datos[i], x + anchoBarra - 20, y + alturaBarra / 2);
            

            ctx.fillStyle = "black";
            // Dibuja los nombres de los productos a la izquierda de las barras
            ctx.fillText(productos[i], 50 , y + alturaBarra / 2);
        }
    }

    dibujarGrafica();
});