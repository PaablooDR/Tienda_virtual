$(document).ready(function () {
    $('#search').keyup(function () {
        var searchValue = $(this).val();
        console.log(searchValue);

        $.ajax({
            type: 'POST',
            url: 'index.php?controller=Category&action=search', // Ruta al controlador de búsqueda
            data: { search: searchValue },
            success: function (response) {
                $('#bodyList').html(response);
            },
            error: function () {
                alert('Error en la solicitud AJAX');
            }
        });
    });
});