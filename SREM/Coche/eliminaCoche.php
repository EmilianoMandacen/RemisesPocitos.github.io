
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
    $sql = "SELECT baja FROM Coche WHERE matricula = '$matricula'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];
        $baja = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE Coche SET baja = '$baja' WHERE matricula = '$matricula'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}


?>