
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['CI'])) {
    $CI = $_POST['CI'];
    $sql = "SELECT baja FROM Chofer WHERE CI = '$CI'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];
        $baja = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE Chofer SET baja = '$baja' WHERE CI = '$CI'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}


?>