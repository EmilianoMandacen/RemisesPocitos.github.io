

<?php
require_once '../conexSql.php';

$matricula = $_POST['matricula'];//x
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$c_pasajeros = $_POST['c_pasajeros'];//x
$CI = $_POST['CI'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$c_salud = $_POST['c_salud'];
$tipo = $_POST['tipo'];//x
$fecha_de_vencimiento_libreta_conducir = $_POST['fecha_de_vencimiento_libreta_conducir'];
$n_padron = $_POST['n_padron'];//x
$seguro_coche = $_POST['seguro_coche'];//x
$tel = $_POST['tel'];



$queryChofer = "INSERT INTO `chofer` (`CI`, `matricula`, `nombre` ,`apellido` ,`c_salud`,`tipo`, `fecha_de_vencimiento_libreta_conducir`)
 VALUES ('$CI', '$matricula', '$nombre', '$apellido', '$c_salud', '$tipo' , '$fecha_de_vencimiento_libreta_conducir')";
$resultChofer = mysqli_query($conn, $queryChofer);

$queryChofer1 = "INSERT INTO `chofer_tel` (`CI`,`tel`) VALUES ('$CI','$tel' )";
$resultChofer1 = mysqli_query($conn, $queryChofer1);

$queryCoche = "INSERT INTO `coche` (`matricula`, `marca`, `modelo`, `c_pasajeros`, `n_padron`, `seguro_coche`) 
            VALUES ('$matricula', '$marca', '$modelo', '$c_pasajeros', '$n_padron', '$seguro_coche' )";
$resultCoche = mysqli_query($conn, $queryCoche);

if ($resultChofer && $resultChofer1 && $resultCoche) {

    echo 'ok';
} else {
    echo 'error';
}
?>