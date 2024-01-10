document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('carousel');
    const images = carousel.getElementsByTagName('img');
    let index = 0;
  
    function cambiarImagen() {
        images[index].style.display = 'none';
        index = (index + 1) % imagenes.length;
        images[index].style.display = 'block';
    }
  
    imagenes[index].style.display = 'block';
    setInterval(cambiarImagen, 5000); // Change after 5 seconds
});