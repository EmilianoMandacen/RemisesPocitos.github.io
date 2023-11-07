<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remises pocitos</title>
    <link rel="icon" href="../img/Remises pocitos.png">
    <link rel="stylesheet" href="../css/inicioAdm.css">
</head>

<body>
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
<input type="hidden" name="ci" value="<?php echo $ci?>">
    <script src="../js/script_salir.js"></script>
    <table class="navbar">
        <tr>
            <td width="50px"></td>
            <td width="10%">
                <a href="<?php echo $resu; ?>" title="Volver al inicio"><img src="../img/Remises pocitos.png" alt=""
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
                                <a href="Chofer/ver_Chofer.php" class="dropdown-op">Ver</a>
                                <a href="Chofer/agregarChofer.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons1">Clientes</a>
                            <div id="buttonContainer1" class="hidden1">
                                <a href="Cliente/ver_Cli.php" class="dropdown-op">Ver</a>
                                <a href="Cliente/agregarCli.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons2">Viajes</a>
                            <div id="buttonContainer2" class="hidden">
                                <a href="Viaje/ver_Viajes.php" class="dropdown-op">Ver</a>
                                <a href="Viaje/agregarViajes.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons3">Coches</a>
                            <div id="buttonContainer3" class="hidden3">
                                <a href="Coche/ver_Coche.php" class="dropdown-op">Ver</a>
                                <a href="#" class="dropdown-op"></a>
                            </div>
                        </li>
                        <li class="dropdown-op2">
                            <a href="#" id="showButtons4">Man. de coches</a>
                            <div id="buttonContainer4" class="hidden4">
                                <a href="Man.coche/ver_ManCoche.php" class="dropdown-op">Ver</a>
                                <a href="Man.coche/agregarManCoche.php" class="dropdown-op">Agregar</a>
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
            <h2>Atencion!!</h2>
            <hr>
            <p>¿Esta seguro de que quiere salir?</p>
            <div class="modal-botones">
                <a href="../Man.Coche/ver_ManCoche.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>

    <?php
        require_once '../conexSql.php';
        $matricula = $_GET['matricula'];
        $query = "SELECT t.matricula, t.fecha, t.importe, t.cod, t.descripcion, m.concepto
        FROM tienen t
        JOIN mantenimiento_coche m ON m.cod = t.cod
        where t.matricula = '$matricula';";
        $result = mysqli_query($conn, $query);
        $json = array();
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $cod = $row['cod'];
                $fecha = $row['fecha'];
                $importe = $row['importe'];
                $descripcion = $row['descripcion'];
                $concepto = $row['concepto'];
            }
        }
    ?>


    <form method="POST" action="editarMan.Coche.php" id="formedt">
        <input type="hidden" name="matricula" value="<?php echo $matricula?>">
        <input type="hidden" name="cod" value="<?php echo $cod?>">
        
        <div class="contenedor">
        <script>
function validarNumero(input) {
    input.value = input.value.replace(/\D/g, '');
}
</script>
            <div class="card6">
            <div class="Coche1">Matricula del coche "<?php echo $matricula?>"</div>
            <br>
                <label class="lebel" title="fechaM">fecha del mantenimiento</label>
                <br><br>
                <input type="date" id="fecha" name="fecha" class="input1" placeholder="fecha..."
                    value="<?php echo $fecha?>" required />
                <br><br>
                <label class="lebel" title="importeM">Importe del mantenimiento</label>
                <br><br>
                <input type="text" id="importe" name="importe" class="input1" placeholder="importe..."
                    value="<?php echo $importe?> " maxlength="6" required oninput="validarNumero(this);"/>
                <br><br>
                <label class="lebel" title="conceptoM">Concepto del mantenimiento</label>
                <br><br>
                    <select id="concepto" name="concepto" title="concepto" class="input2" required>
                    <option value="GASOIL" <?php if ($concepto === 'GASOIL') echo 'selected'; ?>>
                    Gasoil</option>
                    <option value="CAMBIO ACEITE" <?php if ($concepto === 'CAMBIO ACEITE') echo 'selected'; ?>>
                    Cambio de aceite</option>
                    <option value="ELECTRICISTA" <?php if ($concepto === 'ELECTRICISTA') echo 'selected'; ?>>
                    Electricista</option>
                    <option value="ALINEACIÓN Y BALANCEO" <?php if ($concepto === 'ALINEACIÓN Y BALANCEO') echo 'selected'; ?>>
                    Alineación y balanceo</option>
                    <option value="CAMBIO DE CUBIERTA" <?php if ($concepto === 'CAMBIO DE CUBIERTA') echo 'selected'; ?>>
                    Cambio de cubierta</option>
                    <option value="GOMERÍA" <?php if ($concepto === 'GOMERÍA') echo 'selected'; ?>>
                    Gomería</option>
                    <option value="CAMBIO DE CORREA" <?php if ($concepto === 'CAMBIO DE CORREA') echo 'selected'; ?>>
                    Cambio de correa</option>
                    <option value="FRENOS" <?php if ($concepto === 'FRENOS') echo 'selected'; ?>>
                    Frenos</option>
                    <option value="EMBRAGUE" <?php if ($concepto === 'EMBRAGUE') echo 'selected'; ?>>
                    Embrague</option>
                    <option value="CHAPISTA" <?php if ($concepto === 'CHAPISTA') echo 'selected'; ?>>
                    Chapista</option>
                    <option value="OTROS" <?php if ($concepto === 'OTROS') echo 'selected'; ?>>
                    Otros</option>
                </select>
                <br><br>
                <label class="lebel" title="desc">Descripcion</label>
                <br><br>
                    <textarea type="text" name="descripcion" id="descripcion" class="input3" value="<?php echo $descripcion?> "
                    placeholder="descripcion detallada..." maxlength="50" require></textarea>
                <br><br>
            </div>
            <button type="button" class="btn1-3" title="Editar"> Editar Man. Coche</button>
        </div>
        <br><br><br>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
    $(".btn1-3").click(function() {
        $("#formedt").submit();
    });
    </script>
    <script src="../js/script_salir.js"></script>


</body>

</html>