$(document).ready(function () {
    $('#miModal2').hide();
    getAll();
});


// Oculta el btn update

function getAll() {
    $.ajax({

        url: '../Man.Coche/llamaMan.Coche.php',
        type: 'POST',
        data: {
            res: 1
        },

        success: function (response) {
            let ManCoche = JSON.parse(response);
            let ret = '';
            ManCoche.forEach(res => {
                if (res.baja == 1) {
                    ret += `
                        <tr cod="${res.cod}" class="fondorojo" id="emp">
                        <td>${res.matricula}</td>
                        <td>${res.fecha}</td>
                        <td>${res.importe}</td>
                        <td>${res.concepto}</td>
                            <td class="td-btn">
                                <button class="edit" id="btn6" title="Editar" data-matricula="${res.matricula}">
                                    <img src="../img/editar.png" class="img_editar">
                                </button>
                                <button class="delete" title="Eliminar" id="btn7">
                                    <img src="../img/eliminar.png" class="img_basura">
                                </button>
                                <button class="info" title="info" id="btn8"  data-matricula="${res.matricula}">
                                    <img src="../img/info.png" class="img_info">
                                </button>
                            </td>
                        </tr>
                    `;
                }
            });
            $('#data').html(ret);
        }
    });
}


$('#filtrar').on('change', function () {
    var filtro = $(this).val();
    var rows = $('#data').find('tr').get();

    rows.sort(function (a, b) {
        if (filtro === 'concepto') {
            var A = $(a).children('td').eq(3).text().toUpperCase();
            var B = $(b).children('td').eq(3).text().toUpperCase();
            return (A < B) ? -1 : (A > B) ? 1 : 0;
        } else if (filtro === 'fecha') {
            var A = $(a).children('td').eq(1).text().toUpperCase();
            var B = $(b).children('td').eq(1).text().toUpperCase();
            return (A < B) ? -1 : (A > B) ? 1 : 0;
        } else if (filtro === 'matricula') {
            var A = $(a).children('td').eq(0).text().toUpperCase();
            var B = $(b).children('td').eq(0).text().toUpperCase();
            return (A < B) ? -1 : (A > B) ? 1 : 0;
        }else {
            return 0;
        }
    });

    $.each(rows, function (index, row) {
        $('#data').append(row);
    });
});

// Info


$(document).on('click', '.info', function () {
    var matricula = $(this).data("matricula");
    $.ajax({
        url: '../Man.Coche/llamaMan.Coche2.php',
        type: 'POST',
        data: {
            res: 2,
            matricula: matricula,
        },
        success: function (response) {
            let Coche = JSON.parse(response);
            console.log(response);
            Coche.forEach(res => {
                // Recoge los datos de la segunda tabla
                var matricula = res.matricula;
                var concepto = res.concepto;
                var fecha = res.fecha;
                var importe = res.importe;
                var descripcion = res.descripcion;
                // Actualiza el modal con los datos de la segunda tabla
                $('#modalMatricula').text(matricula);
                $('#modalConcepto').text(concepto);
                $('#modalFecha').text(fecha);
                $('#modalImporte').text(importe);
                $('#modalDescripcion').text(descripcion);
            });
            $('#miModal4').show();
            $(document).on('click', '.close2', function () {
                $('#miModal4').hide();
            });
        }
    });
});



// Editar
$(document).on('click', '.edit', function () {
    var matricula = $(this).data("matricula");
    window.location.href = "editar_Man.Coche.php?matricula=" + matricula;
});

// Eliminar
$(document).on('click', '.delete', function () {
    var item = $(this)[0].parentElement.parentElement;
    var cod = $(item).attr('cod');
    $('#miModal2').show();

    $('#ConfirmarEliminar').on('click', function () {
        $('#miModal2').hide();

        $.ajax({
            url: '../Man.Coche/eliminaMan.Coche.php',
            type: 'POST',
            data: {
                cod: cod
            },
            success: function (data) {
                if (data === 'eliminacion_exitosa') {
                    getAll();
                    swal({
                        text: "El man. de coche se eliminó exitosamente."
                    });
                }
                location.reload();
            }
        });
    });

    $('#CancelarEliminar').on('click', function () {
        $('#miModal2').hide();
    });
});


