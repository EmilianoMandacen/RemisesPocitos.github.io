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
        $ci = $_GET['ci'];
        $query = "SELECT u.tipo, u.nom_usu, u.apellido, u.ci, u.contrasena, t.tel
        FROM Usuarios u
        JOIN Usuarios_tel t ON u.ci = t.ci
        where u.ci = '$ci'";
        $result = mysqli_query($conn, $query);
        $json = array();
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $tipo = $row['tipo'];
                $nom_usu = $row['nom_usu'];
                $apellido = $row['apellido'];
                $tel = $row['tel'];
                $contrasena = $row['contrasena'];
            }
        }
    ?>


    <form method="POST" action="editarEmp.php" id="formedt">
        <input type="hidden" name="ci" value="<?php echo $ci?>">
        <div class="contenedor">
            <div class="card5">
                <br><br><br>
                <label class="lebel">Tipo de usuario</label>
                <br><br>
                <select id="tipo" name="tipo" title="Tipo" class="input2" required>
                    <option value="Administrativo" <?php if ($tipo === 'Administrativo') echo 'selected'; ?>>
                        Administrativo</option>
                    <option value="Administrador" <?php if ($tipo === 'Administrador') echo 'selected'; ?>>Administrador
                    </option>
                </select>

                <br><br>
                <label class="lebel" title="Nombre">Nombre del usuario</label>
                <br><br>
                <input type="text" id="nom_usu" name="nom_usu" class="input1" placeholder="Nombre..."
                    value="<?php echo $nom_usu?> " maxlength="10" required />
                <br><br>
                <label class="lebel" title="Apellido">Apellido del usuario</label>
                <br><br>
                <input type="text" id="apellido" name="apellido" class="input1" placeholder="Apellido..."
                    value="<?php echo $apellido?> " maxlength="10" required />
                <br><br>
            </div>
            <div class="card5-1">
                <label class="lebel" title="Contraseña">Contraseña</label>
                <br><br>
                <input type="text" id="contrasena" name="contrasena" class="input1" maxlength="8"
                    placeholder="Contraseña..." value="<?php echo $contrasena?> " required />
                <br><br>
                <label class="lebel" title="Teléfono">Teléfono</label>
                <br><br>
                <input type="text" id="tel" name="tel" class="input1" maxlength="11" placeholder="xxx-xxx-xxx" oninput="formatoTelefono(this)"
                    value="<?php echo $tel?>" required />
                <br><br>
            </div>
            <button type="button" class="btn1" title="Editar"> Editar empleado</button>
        </div>
        <br><br><br>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
    $(".btn1").click(function() {
        $("#formedt").submit();
    });
    </script>

    <script src="../js/cedula.js"></script>
    <script src="../js/formatoTel.js"></script>
    <script src="empleados.js"></script>
    <script src="../js/script_salir.js"></script>


</body>

</html>