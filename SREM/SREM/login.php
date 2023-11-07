<?php
require_once 'conexSql.php';
session_start();

if (isset($_POST['ci'] , $_POST['contrasena'])) {
    $ci = $_POST['ci'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT estado, baja, tipo FROM usuarios WHERE ci = '$ci' and contrasena = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];

        if ($baja == 1) {
            $estado_actual = $row['estado'];
        
            if ($estado_actual == 1) {
                $_SESSION['ci'] = $ci;
                $_SESSION['tipo'] = $row['tipo'];
            
                // Registrar la sesión en la base de datos
                $queryS = "INSERT INTO Sesiones (ci_u) VALUES ('$ci')";
                $resultS = mysqli_query($conn, $queryS);
            
                if ($_SESSION['tipo'] == 'Administrador') {
                    header("Location: inicioAdm.php");
                } elseif ($_SESSION['tipo'] == 'Administrativo') {
                    header("Location: inicio.php");
                }
            } else {
                $_SESSION['error'] = "1"; // Usuario inactivo
                header("Location: index.php");
                exit();
            }
            } else {
            $_SESSION['error'] = "1"; // Usuario inactivo
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "1"; // Usuario inactivo
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['error'] = "1"; // Usuario no encontrado
    header("Location: index.php");
    exit();
}

?>