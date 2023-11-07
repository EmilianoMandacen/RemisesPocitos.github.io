$(document).ready(function () {
    $('#miModal2').hide();
    if ($('#comentario').val() == "" || $('#origen').val() == "" || $('#destino').val() == "" ||
		$('#fecha').val() == "" || $('#hora').val() == "" || $('#costo').val() == "" ||
		$('#tipo').val() == "" || $('#nombre').val() == "" || $('#apellido').val() == "" || 
		$('#tel').val() == "") {
    } else {
        var comentario = $('#comentario').val();
		var origen = $('#origen').val();
		var destino = $('#destino').val();
		var fecha = $('#fecha').val();
		var hora = $('#hora').val();
		var costo = $('#costo').val();
		var tipo = $('#tipo').val();
		var nombre = $('#nombre').val();
		var apellido = $('#apellido').val();
		var tel = $('#tel').val();
        $.ajax({
            url: '../Viaje/guardarV.php.php',
            type: 'POST',
            data: {
                comentario: comentario,
				origen: origen,
				destino: destino,
				fecha: fecha,
				hora: hora,
				costo: costo,
				tipo: tipo,
				nombre: nombre,
				apellido: apellido,
				tel: tel,
            },
            success: function (data) {
                $('#comentario').val('');
				$('#origen').val('');
				$('#destino').val('');
				$('#fecha').val('');
				$('#hora').val('');
				$('#costo').val('');
				$('#tipo').val('');
				$('#nombre').val('');
				$('#apellido').val('');
				$('#tel').val('');
				
                getAll();
            }
        });
    }
});