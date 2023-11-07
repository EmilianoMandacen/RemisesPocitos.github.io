
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['cod_reserva'])) {
    $cod_reserva = $_POST['cod_reserva'];

    $sql = "SELECT baja FROM reserva WHERE cod_reserva = '$cod_reserva'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];
        $baja = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE reserva SET baja = '$baja' WHERE cod_reserva = '$cod_reserva'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}


?>