<?php
	require_once '../conexSql.php';
    
    $matricula = $_POST['matricula'];
    $cod = $_POST['cod'];
    $fecha = $_POST['fecha'];
    $importe = $_POST['importe'];
    $descripcion = $_POST['descripcion'];
    $concepto = $_POST['concepto'];
    
    $query = "UPDATE tienen 
            SET fecha = '$fecha', importe = '$importe', descripcion = '$descripcion'
            WHERE matricula = '$matricula';";
		$result = mysqli_query($conn, $query);

    $query1 = "UPDATE mantenimiento_coche 
            SET concepto = '$concepto'
            WHERE cod = '$cod';";
            $result1 = mysqli_query($conn, $query1);

        if($result && $result1) {
            header("location: ver_ManCoche.php");
        } else {
            echo "Ocurrio un error al editar el mantenimiento del coche";
        }

?>