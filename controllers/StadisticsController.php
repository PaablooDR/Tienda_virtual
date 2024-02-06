<?php
require_once "models/stadistics.php";


class StadisticsController {
    //Menu
    public function stadistics() {
        $topProductsNames = Stadistics::getTopFiveProductsNames(); 
        $topProductsQuantities = Stadistics::getTopFiveProductsQuantities(); 
        require_once("views/admin/stadistics.php");
    }
}
?>