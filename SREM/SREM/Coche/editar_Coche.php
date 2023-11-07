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
            <h2>Atencion!!</h2>
            <hr>
            <p>¿Esta seguro de que quiere salir?</p>
            <div class="modal-botones">
                <a href="../Coche/ver_Coche.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="../logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>

    <?php
        require_once '../conexSql.php';
        $matricula = $_GET['matricula'];
        $query = "SELECT matricula, marca, modelo, c_pasajeros, n_padron, seguro_coche
        FROM coche
        WHERE matricula = '$matricula'";
        $result = mysqli_query($conn, $query);
        $json = array();
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $marca = $row['marca'];
                $modelo = $row['modelo'];
                $c_pasajeros = $row['c_pasajeros'];
                $n_padron = $row['n_padron'];
                $seguro_coche = $row['seguro_coche'];
            }
        }
    ?>


    <form method="POST" action="editarCoche.php" id="formedt">
        <input type="hidden" name="matricula" value="<?php echo $matricula?>">
        
        <div class="contenedor">
        <script>
function padron(input) {
    // Eliminar cualquier carácter que no sea un número
    input.value = input.value.replace(/\D/g, '');
}
</script>
<script>
    function validarNumero(input) {
    // Eliminar cualquier carácter que no sea un número
    input.value = input.value.replace(/\D/g, '');
    if (input.value > 12) {
        input.value = '12';
    }else if (input.value < 1) {
        input.value = '1';
    }
    
}
</script>
            <div class="card6">
                <br><br><br>
                <br><br>
                <label class="lebel" title="MarcaM">Marca del coche</label>
                <br><br>
                <input type="text" id="marca" name="marca" class="input1" placeholder="Marca..."
                    value="<?php echo $marca?>" maxlength="20" required />
                <br><br>
                <label class="lebel" title="ModeloC">Modelo del coche</label>
                <br><br>
                <input type="text" id="modelo" name="modelo" class="input1" placeholder="Modelo..."
                    value="<?php echo $modelo?> " maxlength="20" required />
                <br><br>
                <label class="lebel" title="Cantpasajeros">Cantidad de pasajeros</label>
                <br><br>
                <input type="text" id="c_pasajeros" name="c_pasajeros" class="input1" maxlength="20"
                    placeholder="Cantidad de pasajeros..." value="<?php echo $c_pasajeros?> " required oninput="validarNumero(this);"/>
            </div>
        
            <div class="card6-1">
                <label class="lebel" title="numpadron">Numero de padron</label>
                <br><br>
                <input type="text" id="n_padron" name="n_padron" class="input1" placeholder="Numero de padron..."
                    value="<?php echo $n_padron?> " maxlength="9" required oninput="padron(this);"/>
                <br><br>
                <label class="lebel" title="segurocoche">Seguro del coche</label>
                <br><br>
                    <select id="seguro_coche" name="seguro_coche" title="segurocoche" class="input2" required>
                    <option value="total" <?php if ($seguro_coche === 'total') echo 'selected'; ?>>
                    Total</option>
                    <option value="parcial" <?php if ($seguro_coche === 'parcial') echo 'selected'; ?>>Parcial
                    </option>
                    <option value="por terceros" <?php if ($seguro_coche === 'por terceros') echo 'selected'; ?>>Por terceros
                    </option>
                </select>

                <br><br>
            </div>
            <button type="button" class="btn1-1" title="Editar"> Editar Coche</button>
        </div>
        <br><br><br>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
    $(".btn1-1").click(function() {
        $("#formedt").submit();
    });
    </script>

    <script src="coche.js"></script>
    <script src="../js/script_salir.js"></script>


</body>

</html>