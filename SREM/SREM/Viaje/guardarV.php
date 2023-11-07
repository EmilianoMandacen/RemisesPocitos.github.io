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

    

$queryRe = "INSERT INTO `reserva` (`comentario`, `fecha`, `hora`, `origen`, `destino`, `costo`, `tipo`) 
            VALUES ('$comentario', '$fecha', '$hora', '$origen', '$destino', '$costo', '$tipo')";
$resultRe = mysqli_query($conn, $queryRe);

$lastInsertedId = mysqli_insert_id($conn); // Obtener el último ID insertado

if ($RUT != null) {
    $queryG = "INSERT INTO `Genera` (`cod_reserva`, `RUT`) 
    VALUES ('$lastInsertedId', '$RUT')";
$resultG = mysqli_query($conn, $queryG);

}

$queryRe2 = "INSERT INTO `reserva_pasajero` (`cod_reserva`, `Nombre`, `Apellido`, `tel`) 
            VALUES ('$lastInsertedId', '$Nombre', '$Apellido', '$tel')";
$resultRe2 = mysqli_query($conn, $queryRe2);

if ($resultRe && $resultRe2) {
    echo "Se han insertado los datos correctamente.";
} else {
    echo "Ha ocurrido un error al insertar los datos: " . mysqli_error($conn) . "<br>" . $queryRe . "<br>" . $queryRe2;
}
?>