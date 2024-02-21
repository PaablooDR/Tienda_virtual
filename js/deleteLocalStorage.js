document.addEventListener('DOMContentLoaded',function() {
    document.getElementById('logOut').addEventListener('click', function() {
        borrarTodo();
    });
});

function borrarTodo() {
    localStorage.clear();
    console.log("Todos los ítems del localStorage han sido borrados.");
}
