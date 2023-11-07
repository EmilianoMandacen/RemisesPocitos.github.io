<?php
require_once '../conexSql.php';

$RUT = $_POST['RUT'];
$nom_ficticio = $_POST['nom_ficticio'];
$razon_social = $_POST['razon_social'];
$tel = $_POST['tel'];
$calle = $_POST['calle'];
$n_puerta = $_POST['n_puerta'];
$esquina = $_POST['esquina'];


// Primero, inserta en la tabla Usuarios
$queryCli = "INSERT INTO `Empresa` (`RUT`, `nom_ficticio`, `razon_social`)
 VALUES ('$RUT', '$nom_ficticio', '$razon_social')";
$resultCli = mysqli_query($conn, $queryCli);

$queryCTel = "INSERT INTO `empresa_tel` (`RUT`,`tel`) VALUES ('$RUT', '$tel')";
$resultCTel = mysqli_query($conn, $queryCTel);

$queryCDir = "INSERT INTO `empresa_direccion` (`RUT`, `calle`, `n_puerta`, `Esquina`) 
            VALUES ('$RUT', '$calle', '$n_puerta', '$esquina')";
$resultCDir = mysqli_query($conn, $queryCDir);

if ($resultCli && $resultCTel && $resultCDir) {
    echo 'ok';
} else {
    echo 'error';
}
?>
