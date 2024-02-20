<div id="filters">
    <div>
        <h2>Category</h2>
        <select id="categorySelect">
<?php
            // Variable para almacenar el código de la categoría actualmente seleccionada
            $currentCategoryCode = isset($_GET['categoryCode']) ? $_GET['categoryCode'] : 0;

            // Opción "All"
            $selectedAll = ($currentCategoryCode == 0) ? 'selected' : '';
            echo '<option value="0" ' . $selectedAll . '>All</option>';

            // Opciones para las categorías
            foreach($categories as $category){
                $selected = ($category['code'] == $currentCategoryCode) ? 'selected' : '';
                echo '<option value="' . $category['code'] . '" ' . $selected . '>' . $category['name'] . '</option>';
            }
?>
        </select>
    </div>
    <div>
        <h2>Price</h2>
        <div id="priceRange"></div>
        <output id="minValue">0€</output>
        <output id="maxValue">100€</output>
    </div>
    <div>
        <h3>Order:</h3>
<?php
        if(isset($_GET['order']) && $_GET['order'] == 'ascendant'){
?>
            <input type="radio" name="order" value="all">All<br>
            <input type="radio" name="order" value="ascendant" checked>Ascendant<br>
            <input type="radio" name="order" value="descendant">Descendant<br>
<?php
        }elseif(isset($_GET['order']) && $_GET['order'] == 'descendant'){
?>
            <input type="radio" name="order" value="all">All<br>
            <input type="radio" name="order" value="ascendant">Ascendant<br>
            <input type="radio" name="order" value="descendant" checked>Descendant<br>
<?php
        }else{
?>
            <input type="radio" name="order" value="all" checked>All<br>
            <input type="radio" name="order" value="ascendant">Ascendant<br>
            <input type="radio" name="order" value="descendant">Descendant<br>
<?php
        }
?>
    </div>
    <div>
        <button id="apply">Apply filters</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js"></script>
<script src="js/priceBar.js"></script>