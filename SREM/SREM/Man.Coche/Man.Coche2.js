$(document).ready(function () {
    $('#miModal2').hide();
    if ($('#marticula').val() == "" || $('#concepto').val() == "" || $('#fecha').val() == "" ||
    $('#importe').val() == "" || $('#descripcion').val() == "") {
    } else {
        var matricula = $('#matricula').val();
        var concepto = $('#concepto').val();
        var fecha = $('#fecha').val();
        var importe = $('#importe').val();
        var descripcion = $('#descripcion').val();

        $.ajax({
            url: '../Man.coche/guardarMan.Coche.php',
            type: 'POST',
            data: {
                matricula: matricula,
                concepto: concepto,
                fecha: fecha,
                importe: importe,
                descripcion: descripcion,
            },
            success: function (data) {
                $('#matricula').val('');
                $('#concepto').val('');
                $('#fecha').val('');
                $('#importe').val('');
                $('#descripcion').val('');
                getAll();
            }
        });
    }
});