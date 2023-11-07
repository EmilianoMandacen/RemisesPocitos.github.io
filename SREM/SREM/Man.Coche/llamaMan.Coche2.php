<?php
require_once '../conexSql.php';
$matricula = $_POST['matricula'];
if (isset($_POST['res'])) {
    $query = "SELECT t.matricula, t.fecha, t.importe, t.cod, t.descripcion, m.concepto
    FROM tienen t
    JOIN mantenimiento_coche m ON m.cod = t.cod
    where t.matricula = '$matricula';";
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
                'descripcion' => $row['descripcion'],
            );
        }
        echo json_encode($json);
    } else {
        echo "No devuelve nada";
    }
}
?>
