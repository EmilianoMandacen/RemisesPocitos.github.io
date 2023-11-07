$(document).ready(function () {
    $('#miModal2').hide();
    var ci;
    getAll();


    // Oculta el btn update

    function getAll() {
        $.ajax({
            url: '../Coche/llamaCoche.php',
            type: 'POST',
            data: {
                res: 1
            },
            success: function (response) {
                let Coche = JSON.parse(response);
                let ret = '';
                Coche.forEach(res => {
                    if ( res.baja == 1) { 
                    ret += `
                        <tr cod="${res.matricula}" class="fondorojo" id="emp">
                        <td>${res.matricula}</td>
                        <td>${res.marca}</td>
                        <td>${res.modelo}</td>
                        <td>${res.c_pasajeros}</td>
                        <td>${res.nombre}</td>
                        <td>${res.tel}</td>
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
            if (filtro === 'c_pasajeros') {
                var A = $(a).children('td').eq(3).text().toUpperCase();
                var B = $(b).children('td').eq(3).text().toUpperCase();
                return (A < B) ? -1 : (A > B) ? 1 : 0;
			} else if (filtro === 'nombre') {
				var A = $(a).children('td').eq(4).text().toUpperCase();
				var B = $(b).children('td').eq(4).text().toUpperCase();
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
    console.log(matricula);
        $.ajax({
            url: '../Coche/llamaCoche2.php',
            type: 'POST',
            data: {
                res: 2,
                matricula:matricula,
            },
            success: function (response) {
                let Coche = JSON.parse(response);
                Coche.forEach(res => {
                    // Recoge los datos de la segunda tabla
                    var matricula2 = res.matricula;
                    var marca2 = res.marca;
                    var modelo2 = res.modelo;
                    var c_pasajeros2 = res.c_pasajeros;
                    var CI2 = res.CI;
                    var nombre2 = res.nombre;
                    var apellido2 = res.apellido;
                    var c_salud2 = res.c_salud;
                    var tipo2 = res.tipo;
                    var fecha_de_vencimiento_libreta_conducir2 = res.fecha_de_vencimiento_libreta_conducir;
                    var n_padron2 = res.n_padron;
                    var seguro_coche2 = res.seguro_coche;
                    var tel2 = res.tel;

                    // Actualiza el modal con los datos de la segunda tabla
                    $('#modalMatricula').text(matricula2);
                    $('#modalMarca').text(marca2);
                    $('#modalModelo').text(modelo2);
                    $('#modalPasajeros').text(c_pasajeros2);
                    $('#modalCedulaChofer').text(CI2);
                    $('#modalNombreChofer').text(nombre2);
                    $('#modalApellidoChofer').text(apellido2);
                    $('#modalSaludChofer').text(c_salud2);
                    $('#modalTipoChofer').text(tipo2);
                    $('#modalVencimientoLibreta').text(fecha_de_vencimiento_libreta_conducir2);
                    $('#modaln_padron').text(n_padron2);
                    $('#modalseguro_coche').text(seguro_coche2);
                    $('#modalTelefono ').text(tel2);
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
        window.location.href = "editar_Coche.php?matricula=" + matricula;
    });

    // Eliminar
    $(document).on('click', '.delete', function () {
        var item = $(this)[0].parentElement.parentElement;
        var matricula = $(item).attr('cod');
        $('#miModal2').show();

        $('#ConfirmarEliminar').on('click', function () {
            $('#miModal2').hide();

            $.ajax({
                url: '../Coche/eliminaCoche.php',
                type: 'POST',
                data: {
                    matricula: matricula
                },
                success: function (data) {
                    if (data === 'eliminacion_exitosa') {
                        getAll();
                        swal({
                            text: "El coche se eliminó exitosamente."
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
});
