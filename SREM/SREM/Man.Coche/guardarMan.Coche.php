<?php
require_once '../conexSql.php';


    $matricula = $_POST['matricula'];
    $fecha = $_POST['fecha'];
    $importe = $_POST['importe'];
    $concepto = $_POST['concepto'];
    $descripcion = $_POST['descripcion'];

    $query = "SELECT cod FROM mantenimiento_coche";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cod = $row['cod'];
            $cod = $cod + 1;
        }
    }

    // Realizar la inserción en la tabla 'tienen'
    $queryMan = "INSERT INTO `tienen` (`fecha`, `importe`, `descripcion`, `matricula`, `cod`) 
                VALUES ('$fecha', '$importe', '$descripcion', '$matricula', '$cod')";
    $resultMan = mysqli_query($conn, $queryMan);

    // Realizar la inserción en la tabla 'mantenimiento_coche' sin incluir 'cod' en la consulta
    $queryMan1 = "INSERT INTO `mantenimiento_coche` (`concepto`) VALUES ('$concepto')";
    $resultMan1 = mysqli_query($conn, $queryMan1);

    if ($resultMan && $resultMan1) {
        header("Location: agregarManCoche.php");
    } else {
        echo "Ha ocurrido un error al insertar los datos: " . mysqli_error($conn);
    }

?>
