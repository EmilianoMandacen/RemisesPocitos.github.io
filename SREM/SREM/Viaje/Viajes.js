$(document).ready(function () {
	$('#miModal2').hide();
	var ci;
	getAll();
	$('#save').on('click', function (e) {
		$('#miModal2').hide();
	
		if ($('#tipo').val() === 'Empresa') {
			if ($('#RUT').val() === '') {
				alert("Rellenar los campos!");
				e.preventDefault(); // Evita que el formulario se envíe si el RUT está vacío
				return; // Detiene la ejecución del código
			}
		}
	
		if ($('#comentario').val() === "" || $('#origen').val() === "" || $('#destino').val() === "" ||
			$('#fecha').val() === "" || $('#hora').val() === "" || $('#costo').val() === "" || $('#tipo').val() === "" || $('#Nombre').val() === "" ||
			$('#Apellido').val() === "" || $('#tel').val() === "") {
				alert("Rellenar los campos!");
		} else {
		var comentario = $('#comentario').val();
		var origen = $('#origen').val();
		var destino = $('#destino').val();
		var fecha = $('#fecha').val();
		var hora = $('#hora').val();
		var costo = $('#costo').val();
		var tipo = $('#tipo').val();
		var Nombre = $('#Nombre').val();
		var Apellido = $('#Apellido').val();
		var tel = $('#tel').val();
        var RUT = $('#RUT').val();

        $.ajax({
            url: '../Viaje/guardarV.php',
            type: 'POST',
            data: {
				comentario: comentario,
				origen: origen,
				destino: destino,
				fecha: fecha,
				hora: hora,
				costo: costo,
				tipo: tipo,
				Nombre: Nombre,
				Apellido: Apellido,
				tel: tel,
				RUT: RUT,

            },
            success: function (data) {
				$('#comentario').val('');
				$('#origen').val('');
				$('#destino').val('');
				$('#fecha').val('');
				$('#hora').val('');
				$('#costo').val('');
				$('#tipo').val('');
				$('#Nombre').val('');
				$('#Apellido').val('');
				$('#tel').val('');
				$('#RUT').val('');

				
                getAll();
            }
        });
    }
});

function getAll() {
	$.ajax({
		url: '../Viaje/llamaV.php',
		type: 'POST',
		data: {
			res: 1
		},
		success: function (response) {
			let viaje = JSON.parse(response);
			let ret = '';
			console.log(JSON.parse(response));
			viaje.forEach(res => {
				if ( res.baja == 1) { 
				ret += `
				<tr cod="${res.cod_reserva}" class="fondorojo" id="emp">
					<td>${res.cod_reserva}</td>
					<td>${res.origen}</td>
					<td>${res.destino}</td>
					<td>${res.comentario}</td>
					<td>${res.fecha}</td>
					<td>${res.hora}</td>
					<td>${res.costo}</td>
					<td class="td-btn">
						<button class="edit" id="btn6" title="Editar" data-cod_reserva="${res.cod_reserva}">
							<img src="../img/editar.png" class="img_editar">
						</button>
						<button class="delete" title="Eliminar" id="btn7">
							<img src="../img/eliminar.png" class="img_basura">
						</button>
						<button class="info" title="info" id="btn8"  data-cod_reserva="${res.cod_reserva}" >
						<img src="../img/info.png" class="img_info">
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
		if (filtro === 'cod_reserva') {
            var A = parseInt($(a).children('td').eq(0).text());
            var B = parseInt($(b).children('td').eq(0).text());
            return A - B;
		} else if (filtro === 'fecha') {
			var A = $(a).children('td').eq(4).text().toUpperCase();
			var B = $(b).children('td').eq(4).text().toUpperCase();
			return (A < B) ? -1 : (A > B) ? 1 : 0;
		} else {
			return 0;
		}
	});

	$.each(rows, function (index, row) {
		$('#data').append(row);
	});
});


	//Ver
	$(document).on('click', '.info', function () {
		var cod_reserva = $(this).data("cod_reserva");
		console.log(cod_reserva);
		
		$.ajax({
			url: '../Viaje/llamaV2.php',
			type: 'POST',
			data: {
				res: 2,
				cod_reserva: cod_reserva,
			},
			success: function (response) {
				let Viaje = JSON.parse(response);
				console.log(JSON.parse(response));
				Viaje.forEach(res => {
					// Recoge los datos de la segunda tabla
					var comentario2 = res.comentario;
					var origen2 = res.origen;
					var destino2 = res.destino;
					var fecha2 = res.fecha;
					var hora2 = res.hora;
					var costo2 = res.costo;
					var tipo2 = res.tipo;
					if (tipo2 == 'Empresa') {
						var RUT2 = res.RUT;
					}else{
						if (tipo2 == 'Particular') {
						document.getElementById("RUT2").style.display = "none";
					}
					}
					var Nombre2 = res.Nombre;
					var Apellido2 = res.Apellido;
					var tel2 = res.tel;
	
					// Actualiza el modal con los datos de la segunda tabla
					$('#comentario').text(comentario2);
					$('#origen').text(origen2);
					$('#destino').text(destino2);
					$('#fecha').text(fecha2);
					$('#hora').text(hora2);
					$('#costo').text(costo2);
					$('#tipo').text(tipo2);
					$('#RUT').text(RUT2);
					$('#nombre').text(Nombre2);
					$('#apellido').text(Apellido2);
					$('#tel').text(tel2);
				});
	
				$('#miModal4').show();
				$(document).on('click', '.close2', function () {
					$('#miModal4').hide();
					location.reload();
				});
			}
		});
		
	});
	

	//Editar
	$(document).on('click', '.edit', function () {
		var cod_reserva = $(this).data("cod_reserva");
		window.location.href = "editar_V.php?cod_reserva=" + cod_reserva;
	});

	//Eliminar
	$(document).on('click', '.delete', function () {
		let item = $(this)[0].parentElement.parentElement;
		let cod_reserva = $(item).attr('cod');
		$('#miModal2').show();

		$('#ConfirmarEliminar').on('click', function () {
			$('#miModal2').hide();

			$.ajax({
				url: '../Viaje/eliminaV.php',
				type: 'POST',
				data: {
					cod_reserva: cod_reserva
				},
				success: function (data) {
					if (data === 'eliminacion_exitosa') {
						getAll();
						swal({
							text: "El viaje se eliminó exitosamente.",
						});
					} else {
						swal({
							text: "No se pudo eliminar el viaje. ¡Algo salió mal!",
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
