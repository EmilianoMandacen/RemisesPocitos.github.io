<?php
	require_once '../conexSql.php';
    
    $RUT = $_POST['RUT'];
    $nom_ficticio = $_POST['nom_ficticio'];
    $razon_social = $_POST['razon_social'];
    $calle = $_POST['calle'];
    $n_puerta = $_POST['n_puerta'];
    $esquina = $_POST['esquina'];
    $tel = $_POST['tel'];

    $queryCli = "UPDATE `empresa` SET `nom_ficticio` = '$nom_ficticio', `razon_social` = '$razon_social' WHERE `RUT` = '$RUT'";
   $resultCli = mysqli_query($conn, $queryCli);
   
   $queryCTel = "UPDATE `empresa_tel` SET `tel` = '$tel' WHERE `RUT` = '$RUT'";
   $resultCTel = mysqli_query($conn, $queryCTel);
   
   $queryCDir = "UPDATE `empresa_direccion` SET `calle` = '$calle', `n_puerta` = '$n_puerta', `Esquina` = '$esquina' WHERE `RUT` = '$RUT'";
   $resultCDir = mysqli_query($conn, $queryCDir);

        if($resultCli && $resultCTel && $resultCDir) {
            header("location: ver_Cli.php");
        } else {
            echo "Error al ingresar los datos";
        }
?> 