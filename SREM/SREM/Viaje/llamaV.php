<?php
require_once '../conexSql.php';
if (isset($_POST['res'])) {
	$query = 
	"SELECT r.comentario, r.destino, r.origen, r.hora, r.fecha, r.costo, r.baja, rp.cod_reserva, rp.Nombre, rp.Apellido, rp.tel
	FROM Reserva r
	JOIN Reserva_pasajero rp on rp.cod_reserva = r.cod_reserva
	where baja = 1
	order by rp.cod_reserva asc;";
	$result = mysqli_query($conn, $query);
	$json = array();
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$json[] = array(
				'comentario' => $row['comentario'],
				'destino' => $row['destino'],
				'origen' => $row['origen'],
				'hora' => $row['hora'],
				'fecha' => $row['fecha'],
				'costo' => $row['costo'],
				'baja' => $row['baja'],
				'cod_reserva' => $row['cod_reserva'],
				'Nombre' => $row['Nombre'],
				'Apellido' => $row['Apellido'],
				'tel' => $row['tel'],
			);
		}
		echo json_encode($json);

	} else {
		echo "No devuelve nadaaaa";
	}

}
?>