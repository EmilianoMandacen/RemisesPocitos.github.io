<?php
require_once '../conexSql.php';

if (isset($_POST['res'])) {
    $query = "SELECT t.matricula, t.fecha, t.importe, t.cod, m.concepto, m.baja
    FROM tienen t
    JOIN mantenimiento_coche m ON m.cod = t.cod
    ORDER BY t.matricula asc;";
    $result = mysqli_query($conn, $query);
    $json = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'matricula' => $row['matricula'],
                'fecha' => $row['fecha'],
                'importe' => $row['importe'],
                'cod' => $row['cod'],
                'concepto' => $row['concepto'],
                'baja' => $row['baja'],
            );
        }
        echo json_encode($json);
    } else {
        echo "No devuelve nada";
    }
}
?>
