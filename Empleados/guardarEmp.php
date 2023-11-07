<?php
require_once '../conexSql.php';

$tipo = $_POST['tipo'];
$nom_usu = $_POST['nom_usu'];
$apellido = $_POST['apellido'];
$ci = $_POST['ci'];
$tel = $_POST['tel'];
$contrasena = $_POST['contrasena'];

// Primero, inserta en la tabla Usuarios
$queryUsuarios = "INSERT INTO `Usuarios` (`tipo`, `nom_usu`, `apellido`, `ci`, `contrasena`) VALUES ('$tipo', '$nom_usu', '$apellido', '$ci', '$contrasena')";
$resultUsuarios = mysqli_query($conn, $queryUsuarios);

// Luego, inserta en la tabla Usuarios_tel
$queryUsuariosTel = "INSERT INTO `Usuarios_tel` (`ci`, `tel`) VALUES ('$ci', '$tel')";
$resultUsuariosTel = mysqli_query($conn, $queryUsuariosTel);

if ($resultUsuarios && $resultUsuariosTel) {
    echo 'ok';
} else {
    echo 'error';
}
?>
