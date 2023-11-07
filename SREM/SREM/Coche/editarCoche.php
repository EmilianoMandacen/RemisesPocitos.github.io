<?php
	require_once '../conexSql.php';
    
    $matricula = $_POST['matricula'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $c_pasajeros = $_POST['c_pasajeros'];
    $n_padron = $_POST['n_padron'];
    $seguro_coche = $_POST['seguro_coche'];

    $query = "UPDATE Coche 
        SET marca = '$marca',
            modelo = '$modelo',
            c_pasajeros = '$c_pasajeros',
            n_padron = '$n_padron',
            seguro_coche = '$seguro_coche'
        WHERE matricula = '$matricula'
            ";
		$result = mysqli_query($conn, $query);

        if($result) {
            header("location: ver_Coche.php");
        } else {
            echo "Error al ingresar los datos";
        }

?>