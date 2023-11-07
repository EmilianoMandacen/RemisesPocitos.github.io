$(document).ready(function () {
	$('#miModal2').hide();
	var ci;
	getAll();
	// Oculta el btn update
	//$('#update');
	// Al hacer clic en el btn con id save guarda los items si los campos tiene valores
	$('#save').on('click', function (e) {
		console.log(e);
		if ($('#tipo').val() == "" || $('#nom_usu').val() == "" || $('#apellido').val() == "" || $('#ci').val() == "" || $('#tel').val() == "") {
			alert("Rellenar los campos!");
		} else {
			let ci = $('#ci').val();
			let nom_usu = $('#nom_usu').val();
			let apellido = $('#apellido').val();
			let tipo = $('#tipo').val();
			let tel = $('#tel').val();
			let contrasena = $('#contrasena').val();
			$.ajax({
				url: '../Empleados/guardarEmp.php',
				type: 'POST',
				data: {
					tipo: tipo,
					nom_usu: nom_usu,
					apellido: apellido,
					ci: ci,
					tel: tel,
					contrasena: contrasena,
				},
				success: function (data) {
					$('#tipo').val('');
					$('#nom_usu').val('');
					$('#apellido').val('');
					$('#ci').val('');
					$('#tel').val('');
					$('#contrasena').val('');
					getAll();
				}
			});
		}
	});
	function estadoText(estado) {
		return estado == 1 ? 'Sí' : 'No';
	}
	function bajaText(baja) {
		return baja == 1 ? 'Sí' : 'No';
	}



	function getAll() {
		$.ajax({
			url: '../Empleados/llamaEmp.php',
			type: 'POST',
			data: {
				res: 1
			},
			success: function (response) {
				let Usuarios = JSON.parse(response);
				let ret = '';
				console.log(JSON.parse(response));
				Usuarios.forEach(res => {
					if (res.baja == 1) {
						ret += `
                    <tr cod="${res.ci}" class="fondorojo" id="emp">
                        <td>${res.tipo}</td>
                        <td>${res.nom_usu}</td>
                        <td>${res.apellido}</td>
                        <td>${res.ci}</td>
                        <td>${res.tel}</td>
                        <td>${res.contrasena}</td>
                        <td>${estadoText(res.estado)}</td>
                        <td class="td-btn">
                            <button class="edit" id="btn6" title="Editar" data-ci="${res.ci}">
                                <img src="../img/editar.png" class="img_editar">
                            </button>
                            <button class="delete" title="Eliminar" id="btn7">
                                <img src="../img/eliminar.png" class="img_basura">
                            </button>
                            <button class="disable" title="${res.inhabilitado ? 'Habilitar' : 'Inhabilitar'}" id="btn8">
                                <img src="../img/inav.png" class="img_inav">
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
			if (filtro === 'ci') {
				var A = $(a).children('td').eq(3).text().toUpperCase();
				var B = $(b).children('td').eq(3).text().toUpperCase();
				return (A < B) ? -1 : (A > B) ? 1 : 0;
			} else if (filtro === 'nom_usu') {
				var A = $(a).children('td').eq(1).text().toUpperCase();
				var B = $(b).children('td').eq(1).text().toUpperCase();
				return (A < B) ? -1 : (A > B) ? 1 : 0;
			} else if (filtro === 'tipo') {
                var A = $(a).children('td').eq(0).text().toUpperCase();
                var B = $(b).children('td').eq(0).text().toUpperCase();

                // Ordenar por tipo ascendente: 'Administrador' primero, luego 'Administrativo'
                if (A === 'ADMINISTRADOR' && B === 'ADMINISTRATIVO') {
                    return -1;
                } else if (A === 'ADMINISTRATIVO' && B === 'ADMINISTRADOR') {
                    return 1;
                } else {
                    return (A < B) ? -1 : (A > B) ? 1 : 0;
                }
            } else {
                return 0;
            }
		});

		$.each(rows, function (index, row) {
			$('#data').append(row);
		});
	});







	//inhabilitar
	$(document).on('click', '.disable', function () {
		const ci = $(this).closest('tr').attr('cod');
		const disableButton = $(this);

		$.ajax({
			url: '../Empleados/inhabilitaEmp.php',
			type: 'POST',
			data: {
				ci: ci
			},
			success: function (data) {

				if (data == 'inhab_exitosa') {
					swal({
						text: "No se pudo inhabilitar al cliente. ¡Algo salió mal!",
					});
				} else {

					disableButton.toggleClass('red-button');
					const nuevoEstado = disableButton.hasClass('red-button') ? 1 : 0;
					disableButton.prop('title', nuevoEstado === 1 ? 'Habilitar' : 'Inhabilitar');
					if (nuevoEstado === 1) {
						location.reload(); // Esta línea recargará la página
					} else {
						location.reload(); // Esta línea recargará la página
					}
				}
			},
		});
	});

	//Editar
	$(document).on('click', '.edit', function () {
		var ci = $(this).data("ci");
		window.location.href = "editar_Emp.php?ci=" + ci;
	});

	//Eliminar
	$(document).on('click', '.delete', function () {
		let item = $(this)[0].parentElement.parentElement;
		let ci = $(item).attr('cod');
		$('#miModal2').show();

		$('#ConfirmarEliminar').on('click', function () {
			$('#miModal2').hide();

			$.ajax({
				url: '../Empleados/eliminaEmp.php',
				type: 'POST',
				data: {
					ci: ci
				},
				success: function (data) {
					if (data === 'eliminacion_exitosa') {
						getAll();
						swal({
							text: "El usuario se eliminó exitosamente.",
						});
					} else {
						swal({
							text: "No se pudo eliminar al usuario. ¡Algo salió mal!",
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
