<?php
	require_once '../conexSql.php';
    
    $tipo = $_POST['tipo'];
    $nom_usu = $_POST['nom_usu'];
    $apellido = $_POST['apellido'];
    $contrasena = $_POST['contrasena'];
	$ci = $_POST['ci'];	
    $tel = $_POST['tel'];

    $queryU = "UPDATE `Usuarios` SET `tipo` = '$tipo', `nom_usu` = '$nom_usu', `apellido` = '$apellido', `contrasena` = '$contrasena' WHERE `ci` = '$ci'";
    $resultU = mysqli_query($conn, $queryU);
    
    $queryTel = "UPDATE `Usuarios_tel` SET `tel` = '$tel' WHERE `ci` = '$ci'";
    $resultTel = mysqli_query($conn, $queryTel);

        if($resultU && $resultTel) {
            header("location: ver_emp.php");
        } else {
            echo "Error al ingresar los datos";
        }
?> 