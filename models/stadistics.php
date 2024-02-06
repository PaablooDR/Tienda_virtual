<?php

require_once("BBDD.php");

class Stadistics extends BBDD {

    public static function getTopFiveProductsNames() {
        // Consulta SQL para obtener los nombres de los cinco productos más vendidos.
        $query = "
            SELECT product
            FROM shopping_details
            GROUP BY product
            ORDER BY SUM(amount) DESC
            LIMIT 5
        ";

        try {
            // Preparar la consulta utilizando PDO.
            $statement = BBDD::connect()->prepare($query);
            
            // Ejecutar la consulta.
            $statement->execute();

            // Obtener los resultados en un array.
            $topProductsNames = $statement->fetchAll(PDO::FETCH_COLUMN);

            // Retornar los resultados.
            return $topProductsNames;

        } catch (PDOException $e) {
            // Manejar errores en caso de fallo en la consulta.
            // Puedes personalizar este bloque según tus necesidades.
            return null;
        }
    }

    public static function getTopFiveProductsQuantities() {
        // Consulta SQL para obtener las cantidades totales de los cinco productos más vendidos.
        $query = "
            SELECT SUM(amount) as total_quantity
            FROM shopping_details
            GROUP BY product
            ORDER BY total_quantity DESC
            LIMIT 5
        ";

        try {
            // Preparar la consulta utilizando PDO.
            $statement = BBDD::connect()->prepare($query);
            
            // Ejecutar la consulta.
            $statement->execute();

            // Obtener los resultados en un array.
            $topProductsQuantities = $statement->fetchAll(PDO::FETCH_COLUMN);

            // Retornar los resultados.
            return $topProductsQuantities;

        } catch (PDOException $e) {
            // Manejar errores en caso de fallo en la consulta.
            // Puedes personalizar este bloque según tus necesidades.
            return null;
        }
    }

    public static function getTopFiveCategories(){
        $query = "
        SELECT c.name AS category,
        SUM(sd.amount) AS total_quantity
        FROM Shopping_details sd
        JOIN Product p ON sd.product = p.code
        JOIN Category c ON p.category = c.code
        GROUP BY c.name
        ORDER BY total_quantity DESC
        LIMIT 5;
        ";
        try {
            // Preparar la consulta utilizando PDO.
            $statement = BBDD::connect()->prepare($query);
            
            // Ejecutar la consulta.
            $statement->execute();

            // Obtener los resultados en un array.
            $topFiveCategories = $statement->fetchAll(PDO::FETCH_COLUMN);

            // Retornar los resultados.
            return $topFiveCategories;

        } catch (PDOException $e) {
            // Manejar errores en caso de fallo en la consulta.
            // Puedes personalizar este bloque según tus necesidades.
            return null;
        }
        

    }
}

?>