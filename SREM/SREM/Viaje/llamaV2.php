<?php
require_once '../conexSql.php';
$cod_reserva = $_POST['cod_reserva'];
if (isset($_POST['res'])) {

    $query = "SELECT r.comentario, r.destino, r.origen, r.hora, r.fecha, r.costo, r.tipo, rp.Nombre, rp.Apellido, rp.tel
    FROM Reserva r
    JOIN Reserva_pasajero rp ON rp.cod_reserva = r.cod_reserva
    WHERE r.cod_reserva = '$cod_reserva'";

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
                'tipo' => $row['tipo'],
                'Nombre' => $row['Nombre'],
                'Apellido' => $row['Apellido'],
                'tel' => $row['tel'],
            );

            if ($row['tipo'] == 'Empresa') {
                $query1 = "SELECT e.RUT FROM Empresa e
                JOIN genera g ON e.RUT = g.RUT
                JOIN Reserva r2 ON g.cod_reserva = r2.cod_reserva
                WHERE g.cod_reserva = '$cod_reserva'";

                $result1 = mysqli_query($conn, $query1);
                $row1 = mysqli_fetch_assoc($result1);

                if ($row1) {
                    $json[0]['RUT'] = $row1['RUT'];
                }
            }else{
				if ($row['tipo'] == 'Particular') {
				}
			}
        }

        echo json_encode($json);
    } else {
        echo "No devuelve nada";
    }
}
?>
