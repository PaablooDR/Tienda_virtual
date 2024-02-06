document.addEventListener("DOMContentLoaded", function () {

    // Obtén el elemento canvas y su contexto 2D
    var canvas = document.getElementById("graficaEstadisticas");
    var canvas = document.getElementById("graficaEstadisticas2");

    var ctx = canvas.getContext("2d");

    // Obtener datos desde el atributo de datos HTML
    var datos = JSON.parse(document.getElementById("datosPHP").textContent);
    var productos = JSON.parse(document.getElementById("productosPHP").textContent);
   
    // Configuración de la gráfica
    var alturaBarra = 30;
    var espacioEntreBarras = 20;
    var anchoMaximo = canvas.width * 0.7; // Ancho máximo como el 70% del ancho del canvas

        var anchoMaximo = canvas.width * 0.7; // Ancho máximo como el 70% del ancho del canvas
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

            ctx.fillStyle = "black";
            ctx.textAlign = "left";
            ctx.textBaseline = "middle";
            ctx.font = "bold 12px Arial";
            ctx.fillText(datos[i], x + anchoBarra + 5 , y + alturaBarra / 2);
                 
            // Dibuja los nombres de los productos a la izquierda de las barras
            ctx.fillText(productos[i], 50 , y + alturaBarra / 2);
        }
    }

    dibujarGrafica();


    var ctx2 = canvas2.getContext("2d");

    // Obtener datos desde el atributo de datos HTML
    var datos = JSON.parse(document.getElementById("datosPHP").textContent);
    var productos = JSON.parse(document.getElementById("productosPHP").textContent);
   
    // Configuración de la gráfica
    var alturaBarra = 30;
    var espacioEntreBarras = 20;
    var anchoMaximo = canvas.width * 0.7; // Ancho máximo como el 70% del ancho del canvas

        var anchoMaximo = canvas.width * 0.7; // Ancho máximo como el 70% del ancho del canvas
    var marginLeft = 110; // Margen a la izquierda para los nombres de los productos
    var marginTop = 50; // Margen superior para la gráfica

    var colores = ["#64ADFF", "#FFA07A", "#FFB6C1", "#90EE90", "#FF837F"];

    function dibujarGrafica2() {
        
        // Limpia el canvas
        ctx2.clearRect(0, 0, canvas.width, canvas.height);
        
        // Dibuja cada barra
        for (var i = 0; i < datos.length; i++) {
            var anchoBarra = (datos[i] / Math.max(...datos)) * anchoMaximo;
            var y = i * (alturaBarra + espacioEntreBarras)+ marginTop;
            var x = marginLeft;

            ctx2.fillStyle = colores[i % colores.length];
            ctx2.fillRect(x, y, anchoBarra, alturaBarra);

            ctx2.fillStyle = "black";
            ctx2.textAlign = "left";
            ctx2.textBaseline = "middle";
            ctx2.font = "bold 12px Arial";
            ctx2.fillText(datos[i], x + anchoBarra + 5 , y + alturaBarra / 2);
                 
            // Dibuja los nombres de los productos a la izquierda de las barras
            ctx2.fillText(productos[i], 50 , y + alturaBarra / 2);
        }
    }

    dibujarGrafica2();
});