<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remises pocitos</title>
    <link rel="icon" href="../img/Remises pocitos.png">
    <link rel="stylesheet" href="../css/inicioAdm.css">
</head>

<body onload="mostrarCampos()">
    <?php
session_start();
error_reporting(0);
$ci = $_SESSION['ci'];
if (!isset($ci)) {
location ("index.php");
}
?>
    <?php
session_start();
require_once '../conexSql.php';

$ci = $_SESSION['ci'];

$sql = "SELECT tipo FROM Usuarios WHERE ci = '$ci'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $tipo_usuario = $row['tipo'];

    // Redirige según el tipo de usuario
    if ($tipo_usuario === 'Administrador') {
        $resu = '../inicioAdm.php';
    } elseif ($tipo_usuario === 'Administrativo') {
        $resu = '../inicio.php';
    }
}
?>
    <table class="navbar">
        <tr>
            <td width="50px"></td>
            <td width="10%">
                <a href="../inicioAdm.php" title="Volver al inicio"><img src="../img/Remises pocitos.png" alt=""
                        class="img1"></a>
            </td>
            <td>
                <div class="dropdown" title="Expandir">
                    <button class="dropdown-toggle"><img src="../img/hamburguesa.png" alt="" class="img2"></button>
                    <ul class="dropdown-menu">
                        <?php
session_start();

// Verificar si el usuario es un Administrador
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'Administrador') {
    $tipo_usuario = $_SESSION['tipo'];
?>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons">Empleados</a>
                            <div id="buttonContainer" class="hidden">
                                <a href="../Empleados/ver_emp.php" class="dropdown-op">Ver</a>
                                <a href="../Empleados/agregarEmp.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons1">Choferes</a>
                            <div id="buttonContainer1" class="hidden1">
                                <a href="../Chofer/ver_Chofer.php" class="dropdown-op">Ver</a>
                                <a href="../Chofer/agregarChofer.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons2">Clientes</a>
                            <div id="buttonContainer2" class="hidden2">
                                <a href="../Cliente/ver_Cli.php" class="dropdown-op">Ver</a>
                                <a href="../Cliente/agregarCli.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons3">Viajes</a>
                            <div id="buttonContainer3" class="hidden3">
                                <a href="../Viaje/ver_Viajes.php" class="dropdown-op">Ver</a>
                                <a href="../Viaje/agregarViajes.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons4">Coches</a>
                            <div id="buttonContainer4" class="hidden4">
                                <a href="../Coche/ver_Coche.php" class="dropdown-op">Ver</a>
                                <a href="#" class="dropdown-op"></a>
                            </div>
                        </li>
                        <li class="dropdown-op2">
                            <a href="#" id="showButtons5">Man. de coches</a>
                            <div id="buttonContainer5" class="hidden5">
                                <a href="../Man.coche/ver_ManCoche.php" class="dropdown-op">Ver</a>
                                <a href="../Man.coche/agregarManCoche.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                    </ul>
                    <?php
}
?>
                    <?php
session_start();

// Verificar si el usuario es un Administrador
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'Administrativo') {
    $tipo_usuario = $_SESSION['tipo'];
?>
                    <li class="dropdown-op1">
                        <a href="#" id="showButtons">Choferes</a>
                        <div id="buttonContainer" class="hidden">
                            <a href="../Chofer/ver_Chofer.php" class="dropdown-op">Ver</a>
                            <a href="../Chofer/agregarChofer.php" class="dropdown-op">Agregar</a>
                        </div>
                    </li>
                    <li class="dropdown-op1">
                        <a href="#" id="showButtons1">Clientes</a>
                        <div id="buttonContainer1" class="hidden1">
                            <a href="../Cliente/ver_Cli.php" class="dropdown-op">Ver</a>
                            <a href="../Cliente/agregarCli.php" class="dropdown-op">Agregar</a>
                        </div>
                    </li>
                    <li class="dropdown-op1">
                        <a href="#" id="showButtons2">Viajes</a>
                        <div id="buttonContainer2" class="hidden">
                            <a href="../Viaje/ver_Viajes.php" class="dropdown-op">Ver</a>
                            <a href="../Viaje/agregarViajes.php" class="dropdown-op">Agregar</a>
                        </div>
                    </li>
                    <li class="dropdown-op1">
                        <a href="#" id="showButtons3">Coches</a>
                        <div id="buttonContainer3" class="hidden3">
                            <a href="../Coche/ver_Coche.php" class="dropdown-op">Ver</a>
                            <a href="#" class="dropdown-op"></a>
                        </div>
                    </li>
                    <li class="dropdown-op2">
                        <a href="#" id="showButtons4">Man. de coches</a>
                        <div id="buttonContainer4" class="hidden4">
                            <a href="../Man.coche/ver_ManCoche.php" class="dropdown-op">Ver</a>
                            <a href="../Man.coche/agregarManCoche.php" class="dropdown-op">Agregar</a>
                        </div>
                    </li>
                    </ul>
                    <?php
}
?>
                </div>
                <script src="../js/hamburguesa2.js"></script>
            </td>
            <td width="1370px"></td>
            <td>
                <button class="btn2" id="mostrarModal">Salir</button>
            </td>
            <td width="50px"></td>
        </tr>
    </table>
    <div id="miModal" class="modal">
        <div class="modal-contenido">
            <h2>¡¡¡Atención!!!</h2>
            <hr>
            <p>¿Está seguro de que quiere salir?</p>
            <div class="modal-botones">
                <a href="" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="../logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>

    <?php
        require_once '../conexSql.php';
        $cod_reserva = $_GET['cod_reserva'];
        $query = "SELECT r.comentario, r.destino, r.origen, r.hora, r.fecha, r.costo, rp.Nombre, rp.Apellido, rp.tel, r.tipo
        FROM Reserva r
        JOIN Reserva_pasajero rp on rp.cod_reserva = r.cod_reserva
        where r.cod_reserva = '$cod_reserva';";
        $result = mysqli_query($conn, $query);
        $json = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $comentario = $row['comentario'];
                $destino = $row['destino'];
                $origen = $row['origen'];
                $hora = $row['hora'];
                $fecha = $row['fecha'];
                $costo = $row['costo'];
                $Nombre = $row['Nombre'];
                $Apellido = $row['Apellido'];
                $tel = $row['tel'];
                $tipo = $row['tipo'];

                if ($row['tipo'] == 'Empresa') {
                    $query1 = "SELECT e.RUT FROM Empresa e
                    JOIN genera g ON e.RUT = g.RUT
                    JOIN Reserva r2 ON g.cod_reserva = r2.cod_reserva
                    WHERE g.cod_reserva = '$cod_reserva'";
    
                    $result1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_assoc($result1);
    
                    if ($row1) {
                        $RUT = $row1['RUT']; // Asegúrate de que estás utilizando la clave correcta en el array

                    }
                }
            }
        }
    ?>
    <?php
    require_once '../conexSql.php';
    
    $query = "SELECT RUT FROM Empresa";
    $result = mysqli_query($conn, $query);
    $RUT2 = array();

    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $RUT2[] = $row['RUT'];
        }
    }
?>



    <form method="POST" action="editarV.php" id="formedt">

        <div class="contenedor">

            <div class="card8">
                <br><br><br>
                <input type="hidden" name="cod_reserva" value="<?php echo $cod_reserva?>">

                <label class="lebel" title="origen">Origen del viaje</label>
                <br><br>
                <input type="text" name="origen" id="origen" class="input1" value="<?php echo $origen?>"
                    placeholder="Origen..." maxlength="20" required />
                <br><br>
                <label class="lebel" title="destino">Destino del viaje</label>
                <br><br>
                <input type="text" name="destino" id="destino" class="input1" maxlength="20"
                    value="<?php echo $destino?>" placeholder="Destino..." required />
                <br><br>
                <label class="lebel" title="comentario">Comentario</label>
                <br><br>
                <input type="text" name="comentario" id="comentario" class="input1" value="<?php echo $comentario?>"
                    placeholder="Comentario..." maxlength="20" required />
                <br><br>
                <label class="lebel" title="costo">Costo del viaje</label>
                <br><br>
                <input type="text" name="costo" id="costo" class="input1" maxlength="6" value="<?php echo $costo?>"
                    placeholder="Costo..." required oninput="validarNumero(this);" />
                <br><br>
                <label class="lebel" title="fecha">Fecha del viaje</label>
                <br><br>
                <input type="date" name="fecha" id="fecha" value="<?php echo $fecha?>" class="input1" required />
                <br><br>
                <label class="lebel" title="hora">Hora del viaje</label>
                <br><br>
                <input type="time" name="hora" id="hora" class="input1" value="<?php echo $hora?>" required />
                <br><br>
            </div>
            <div class="card8">
                <br><br><br>
                <label class="lebel" title="tipo">Tipo de cliente</label>
                <br><br>
                <select id="tipo" name="tipo" title="tipo" class="input2" required onchange="mostrarCampos()">
                    <option value="Empresa" <?php if ($tipo === 'Empresa') echo 'selected'; ?>>Empresa</option>
                    <option value="Particular" <?php if ($tipo === 'Particular') echo 'selected'; ?>>Particular</option>
                </select>
                <br><br>

                <div id="camposEmpresa" style="display: none;">
    <label class="lebel" title="rut">RUT</label>
    <br><br>
    <select id="RUT" name="RUT" title="RUT" class="input2" required>
        <?php
        foreach ($RUT2 as $rutOption) {
            $selected = ($rutOption == $RUT) ? 'selected' : '';
            echo "<option value='$rutOption' $selected>$rutOption</option>";
        }
        ?>
    </select>
</div>

                <br>
                <label class="lebel" title="Nombre">Nombre</label>
                <br><br>
                <input type="text" name="Nombre" id="Nombre" class="input1" maxlength="30" value="<?php echo $Nombre?>"
                    placeholder="Nombre..." required />
                <br><br>
                <label class="lebel" title="apellido">Apellido</label>
                <br><br>
                <input type="text" name="Apellido" id="Apellido" class="input1" value="<?php echo $Apellido?>"
                    placeholder="Apellido..." maxlength="20" required />
                <br><br>
                <label class="lebel" title="telefono">Teléfono</label>
                <br><br>
                <input type="text" name="tel" id="tel" class="input1" value="<?php echo $tel?>"
                    oninput="formatoTelefono(this)" maxlength="11" placeholder="Teléfono..." required />
            </div>
            <button type="button" class="btn1-5" title="Editar"> Editar viaje</button>
        </div>
        <br><br><br>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>

    <script>
    function mostrarCampos() {
        var tipo = document.getElementById("tipo").value;
        var camposEmpresa = document.getElementById("camposEmpresa");

        if (tipo === 'Empresa') {
            camposEmpresa.style.display = 'block';
        } else {
            camposEmpresa.style.display = 'none';
        }
    }
    $(".btn1-5").click(function() {
        $("#formedt").submit();
    });
    </script>

    <script src="../js/cedula.js"></script>
    <script src="../js/formatoTel.js"></script>
    <script src="Viajes.js"></script>
    <script src="../js/script_salir.js"></script>


</body>

</html>