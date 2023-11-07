<?php
require_once 'conexSql.php';
session_start();


if (!isset($_SESSION['ci'])) {
    header("Location: index.php");
    exit();
}

$ci = $_SESSION['ci'];
$query = " SELECT u.nom_usu, u.apellido, t.tel
FROM Usuarios u
JOIN Usuarios_tel t ON u.ci = t.ci
WHERE u.ci = '$ci'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nom_usu = $row['nom_usu'];
    $apellido = $row['apellido'];
    $tel = $row['tel'];
} else {
    die("Error al obtener los datos del perfil: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_usu = $_POST['nom_usu'];
    $apellido = $_POST['apellido'];
    $tel = $_POST['tel'];

    $update_query = "UPDATE Usuarios AS u
    JOIN Usuarios_tel AS t ON u.ci = t.ci
    SET u.nom_usu = '$nom_usu',
        u.apellido = '$apellido',
        t.tel = '$tel'
    WHERE u.ci = '$ci';
    ";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        header("Location: editar_perfilAdm.php");
        exit();
    } else {
        die("Error al actualizar el perfil: " . mysqli_error($conn));
    }
}
?>