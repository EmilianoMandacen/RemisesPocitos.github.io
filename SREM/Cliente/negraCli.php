<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['RUT'])) {
    $RUT = $_POST['RUT'];
    
    $sql = "SELECT lista_negra FROM Empresa WHERE RUT = '$RUT'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lista_negra= $row['lista_negra'];
        $lista_negra1 = ($lista_negra == 1) ? 0 : 1;
        $sql_update = "UPDATE Empresa SET lista_negra = '$lista_negra1' WHERE RUT = '$RUT'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'negra_exitosa';
        }
    }
}


?>