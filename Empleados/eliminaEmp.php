
<?php
require_once '../conexSql.php';
session_start();
if (isset($_POST['ci'])) {
    $ci = $_POST['ci'];
    if ($ci === $_SESSION['ci']) {
        echo 'error: No puedes eliminar tu propio usuario.';
    } else { 
    $sql = "SELECT baja FROM usuarios WHERE ci = '$ci'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $baja = $row['baja'];
        $baja = ($baja == 1) ? 0 : 1;
        $sql_update = "UPDATE usuarios SET baja = '$baja' WHERE ci = '$ci'";
        if ($conn->query($sql_update) === TRUE) {
            echo 'cambio_exitoso';
        }
    }
}
}

?>