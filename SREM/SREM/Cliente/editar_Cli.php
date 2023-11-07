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
<table class="navbar">
        <tr>
            <td width="50px"></td>
            <td width="10%">
                <a href="../inicioAdm.php" title="Volver al inicio"><img src="../img/Remises pocitos.png" alt="" class="img1"></a>
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
        $RUT = $_GET['RUT'];
        $query = "SELECT e.RUT, e.nom_ficticio, e.razon_social, ed.calle, ed.n_puerta, ed.esquina, et.tel, e.baja
        FROM empresa e
        JOIN empresa_direccion ed ON ed.RUT = e.RUT
        JOIN empresa_tel et ON et.RUT = e.RUT
        WHERE e.RUT = '$RUT'";
        $result = mysqli_query($conn, $query);
        $json = array();
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $RUT = $row['RUT'];
                $nom_ficticio = $row['nom_ficticio'];
                $razon_social = $row['razon_social'];
                $calle = $row['calle'];
                $n_puerta = $row['n_puerta'];
                $esquina = $row['esquina'];
                $tel = $row['tel'];
                $baja = $row['baja'];
            }
        }
    ?>


    <form method="POST" action="editarCli.php" id="formedt">
        <input type="hidden" name="RUT" value="<?php echo $RUT?>">
        <div class="contenedor">
            <div class="card5">
                <br><br><br>
                <label class="lebel" title="nom_ficticio">Nombre ficticio</label>
                <br><br>
                <input type="text" id="nom_ficticio" name="nom_ficticio" class="input1" value="<?php echo $nom_ficticio?>" placeholder="Nombre ficticio..." maxlength="50" required />
                <br><br>
                <label class="lebel" title="razon_social">Razon social</label>
                <br><br>
                <input type="text" id="razon_social" name="razon_social" class="input1" maxlength="50" value="<?php echo $razon_social?>" placeholder="Razon social..."
                required />
                <br><br>
                <label class="lebel" title="Teléfono">Teléfono</label>
                <br><br>
                <input type="text" id="tel" name="tel" class="input1" maxlength="11" value="<?php echo $tel?>" placeholder="xxx-xxx-xxx"
                    oninput="formatoTelefono(this)" required />
                    <br><br>
            </div>
            <div class="card5">
                <br><br><br>
                <label class="lebel" title="calle">Calle</label>
                <br><br>
                <input type="text" id="calle" name="calle" class="input1" maxlength="50" value="<?php echo $calle?>" placeholder="calle..." required />
                <br><br>
                <label class="lebel" title="Teléfono">Numero de puerta</label>
                <br><br>
                <input type="text" id="n_puerta" name="n_puerta"  class="input1" maxlength="7" value="<?php echo $n_puerta?>" placeholder="Numero de puerta..."
                required />
                <br><br>
                <label class="lebel" title="esquina">Esquina</label>
                <br><br>
                <input type="text" id="esquina" name="esquina" class="input1" maxlength="50" value="<?php echo $esquina?>" placeholder="Esquina..."
                required />
            </div>
            <button type="button" class="btn1-4" title="Editar"> Editar cliente</button>
        </div>
        <br><br><br>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
    $(".btn1-4").click(function() {
        $("#formedt").submit();
    });
    </script>

    <script src="../js/cedula.js"></script>
    <script src="../js/formatoTel.js"></script>
    <script src="Cliente.js"></script>
    <script src="../js/script_salir.js"></script>


</body>

</html>