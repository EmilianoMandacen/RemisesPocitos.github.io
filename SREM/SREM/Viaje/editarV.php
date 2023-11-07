<?php
	require_once '../conexSql.php';
    
    $comentario = $_POST['comentario'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $costo = $_POST['costo'];
    $tipo = $_POST['tipo'];
    $tel = $_POST['tel'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $RUT = $_POST['RUT'];
    $cod_reserva = $_POST['cod_reserva'];

    $queryRE = "UPDATE `reserva` SET `comentario` = '$comentario', `fecha` = '$fecha', `hora` = '$hora', `origen` = '$origen', `destino` = '$destino', `costo` = '$costo', `tipo` = '$tipo' WHERE `cod_reserva` = $cod_reserva";
    $resultRE = mysqli_query($conn, $queryRE);

    $queryRE2 = "UPDATE `reserva_pasajero` SET `Nombre` = '$Nombre', `Apellido` = '$Apellido', `tel` = '$tel' WHERE `cod_reserva` = $cod_reserva";
    $resultRE2 = mysqli_query($conn, $queryRE2);

    $queryG = "UPDATE `Genera` SET `RUT` = '$RUT' WHERE `cod_reserva` = $cod_reserva";
    $resultG = mysqli_query($conn, $queryG);


        if($resultRE && $resultRE2 && $resultG) {
            header("location: ver_Viajes.php");
        } else {
            echo "Error al ingresar los datos";
        }
?>