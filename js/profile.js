
$(document).ready(function() {
    $('.btn-open-popup').on('click', function() {
        var targetPopup = $(this).data('popup-target');
        $(targetPopup).show()[0].showModal();
    });

    $('.btn-close-popup').on('click', function() {
        $(this).closest('dialog').hide()[0].close();
    });
});