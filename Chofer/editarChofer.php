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

    $query1 = "UPDATE Chofer_tel
    SET tel = '$tel'
    WHERE CI = '$CI'";
    
    $query2= "UPDATE Chofer
    SET nombre = '$nombre',
        apellido = '$apellido',
        c_salud = '$c_salud',
        tipo = '$tipo',
        fecha_de_vencimiento_libreta_conducir = '$fecha_de_vencimiento_libreta_conducir'
    WHERE CI = '$CI'";
    
    $query3= "UPDATE Coche 
        SET marca = '$marca',
            modelo = '$modelo',
            c_pasajeros = '$c_pasajeros',
            n_padron = '$n_padron',
            seguro_coche = '$seguro_coche'
        WHERE matricula = '$matricula'
            ";

		$result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        $result3 = mysqli_query($conn, $query3);
        if($result1 && $result2 && $result3) {
            header("location: ver_Chofer.php");
        } else {
            echo "$que";
        }
?>