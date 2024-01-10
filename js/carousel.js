document.addEventListener('DOMContentLoaded', function () {
    const outstanding = document.getElementById('outstanding');
    const carousel = outstanding.querySelector('#carousel');
    const images = carousel.getElementsByTagName('img');
    let index = 0;
  
    function cambiarImagen() {
        images[index].style.display = 'none';
        index = (index + 1) % images.length;
        images[index].style.display = 'block';
    }
  
    images[index].style.display = 'block';
    setInterval(cambiarImagen, 5000); // Cambia después de 5 segundos
});
