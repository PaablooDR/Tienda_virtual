<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css">
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='./js/assets/tilt.jquery.js'></script>
        <script src='./js/products.js'></script>
        
        <title>Index</title>
    </head>
    <body>
<?php 
    require_once "autoload.php";
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = explode('/', $url);

    // Verifica si la URL contiene "/admin"
    if (in_array('admin', $urlParts)) {
        // Si es así, establece el controlador y la acción para la parte de administrador
        $nombreController = "AdminController";
        $action = isset($urlParts[2]) ? $urlParts[2] : 'login';
    } else if (isset($_GET['controller'])) {
        // Si se proporciona un controlador a través de $_GET, úsalo
        $nombreController = $_GET['controller']."Controller";
    } else {
        // Controlador por defecto
        $nombreController = "ProductController";
    }
    
    if (class_exists($nombreController)) {
        $controlador = new $nombreController(); 
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = "principal";
        }
        $controlador->$action();   
    } else {
        echo "No existe el controlador";
    }
    //   require_once "views/general/footer.html";
?>

    </body>
</html>