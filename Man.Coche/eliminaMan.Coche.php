
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['cod'])) {
    $cod = $_POST['cod'];
    $sql = "SELECT baja FROM mantenimiento_coche WHERE cod = '$cod'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];
        $baja = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE mantenimiento_coche SET baja = '$baja' WHERE cod = '$cod'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}


?>