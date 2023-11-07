<?php
require_once 'conexSql.php';
session_start();

// Obtener la cédula del usuario
$ci = $_SESSION['ci'];

// Eliminar la cédula de usuario de la tabla Sesiones
$querySe = "DELETE FROM Sesiones WHERE ci_u = '$ci'";
$resultSe = mysqli_query($conn, $querySe);

session_destroy();
header("Location: index.php");
?>
