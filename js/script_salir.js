window.addEventListener('load', function () {
    var modal = document.getElementById('miModal');
    var btnMostrarModal = document.getElementById('mostrarModal');

    btnMostrarModal.addEventListener('click', function () {
        modal.style.display = 'block';
    });


});
var btnCancelarModal = document.getElementById('cancelarModal');

btnCancelarModal.addEventListener('click', function () {
    modal.style.display = 'none';
});