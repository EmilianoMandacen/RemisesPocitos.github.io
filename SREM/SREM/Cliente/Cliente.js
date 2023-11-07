$(document).ready(function () {
	$('#miModal2').hide();
	getAll();
	$('#save').on('click', function (e) {
		console.log(e);
		if ($('#RUT').val() == "" || $('#nom_ficticio').val() == "" || $('#razon_social').val() == "" 
		|| $('#calle').val() == "" || $('#n_puerta').val() == ""|| $('#esquina').val() == ""
		|| $('#tel').val() == "") {
			alert("Rellenar los campos!");
		} else {
			let RUT = $('#RUT').val();
			let nom_ficticio = $('#nom_ficticio').val();
			let razon_social = $('#razon_social').val();
			let calle = $('#calle').val();
			let n_puerta = $('#n_puerta').val();
			let esquina = $('#esquina').val();
			let tel = $('#tel').val();


			$.ajax({
				url: '../Cliente/guardarCli.php',
				type: 'POST',
				data: {
					RUT: RUT,
					nom_ficticio: nom_ficticio,
					razon_social: razon_social,
					calle: calle,
					n_puerta: n_puerta,
					esquina: esquina,
					tel: tel
				},
				success: function (data) {
					$('#RUT').val('');
					$('#nom_ficticio').val('');
					$('#razon_social').val('');
					$('#calle').val('');
					$('#n_puerta').val('');
					$('#esquina').val('');
					$('#tel').val('');
					getAll();
				}
			});
		}
	});
	function listaTXT(lista_negra) {
        return lista_negra == 1 ? 'Sí' : 'No';
    }

    function getAll() {
        $.ajax({
            url: '../Cliente/llamaCli.php',
            type: 'POST',
            data: {
                res: 1
            },
            success: function (response) {
                let Empresa = JSON.parse(response);
                let ret = '';
                console.log(JSON.parse(response));
                Empresa.forEach(res => {
					if ( res.baja == 1) { 
                    ret += `
                    <tr cod="${res.RUT}" class="fondorojo" id="emp">
                        <td>${res.RUT}</td>
						<td>${res.nom_ficticio}</td>
						<td>${res.razon_social}</td>
						<td>${res.tel}</td>
						<td>${res.calle}, ${res.n_puerta}, ${res.esquina}</td>
						<td>${listaTXT(res.lista_negra)}</td>
                        <td class="td-btn">
						<button class="edit" id="btn6" title="Editar" data-rut="${res.RUT}">
						<img src="../img/editar.png" class="img_editar">
					</button>
                            <button class="delete" title="Eliminar" id="btn7">
                                <img src="../img/eliminar.png" class="img_basura">
                            </button>
                            <button class="negra" title="${res.RUT}" id="btn8">
                                <img src="../img/ListaNegra.png" class="img_Negra">
                            </button>
                        </td>
                    </tr>
                    `
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
			if (filtro === 'RUT') {
				var A = $(a).children('td').eq(0).text().toUpperCase();
				var B = $(b).children('td').eq(0).text().toUpperCase();
				return (A < B) ? -1 : (A > B) ? 1 : 0;
			} else if (filtro === 'nom_ficticio') {
				var A = $(a).children('td').eq(1).text().toUpperCase();
				var B = $(b).children('td').eq(1).text().toUpperCase();
				return (A < B) ? -1 : (A > B) ? 1 : 0;
			} else if (filtro === 'lista_negra') {
				var A = $(a).children('td').eq(5).text().toUpperCase();
				var B = $(b).children('td').eq(5).text().toUpperCase();
				return (A < B) ? 1 : (A > B) ? -1 : 0;
            } else {
                return 0;
            }
		});

		$.each(rows, function (index, row) {
			$('#data').append(row);
		});
	});
	
	//Negra
	$(document).on('click', '.negra', function () {
			let item = $(this)[0].parentElement.parentElement;
			let RUT = $(item).attr('cod');
				$.ajax({
					url: '../Cliente/negraCli.php',
					type: 'POST',
					data: {
						RUT:RUT
					},
					success: function (data) {
						if (data === 'negra_exitosa') {
							getAll();
					}
					location.reload();
				}
			});
	
			$('#CancelarEliminar').on('click', function () {
				$('#miModal2').hide();
			});
		});
	
	});
	

	//Editar
$(document).on('click', '.edit', function () {
	let item = $(this)[0].parentElement.parentElement;
	let RUT = $(item).attr('cod');
    console.log(RUT);
    window.location.href = "editar_Cli.php?RUT=" + RUT;
});


	//Eliminar
	$(document).on('click', '.delete', function () {
		let item = $(this)[0].parentElement.parentElement;
		let RUT = $(item).attr('cod');
		$('#miModal2').show();

		$('#ConfirmarEliminar').on('click', function () {
			$('#miModal2').hide();

			$.ajax({
				url: '../Cliente/eliminaCli.php',
				type: 'POST',
				data: {
					RUT:RUT
				},
				success: function (data) {
					if (data === 'eliminacion_exitosa') {
						getAll();
						swal({
							text: "El Cliente se eliminó exitosamente.",
						});
					} else {
						swal({
							text: "No se pudo eliminar al Cliente. ¡Algo salió mal!",
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

