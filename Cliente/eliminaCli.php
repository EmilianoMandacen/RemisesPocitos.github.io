
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['RUT'])) {
    $RUT = $_POST['RUT'];
    
    $sql = "SELECT baja FROM Empresa WHERE RUT = '$RUT'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja= $row['baja'];
        $baja1 = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE Empresa SET baja = '$baja1' WHERE RUT = '$RUT'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}


?>