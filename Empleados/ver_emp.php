<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

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
    <script src="../js/script_salir.js"></script>
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
            <h2>Atención!!</h2>
            <hr>
            <p>¿Está seguro de que quiere salir?</p>
            <div class="modal-botones">
                <a href="../Empleados/ver_emp.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="../logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>
    <div class="filtro">
        <label for="filtrar" class="txt5">Ordenar por:</label>
        <select name="Filtro" id="filtrar" style="background-color: #ACACAD;">
        <option value="tipo" selected>Tipo</option>
            <option value="ci">Cédula</option>
            <option value="nom_usu">Nombre</option>
        </select>
    </div>
    <br><br><br><br>
    <div class="card2">
        <table class="content-table">
            <thead>
                <tr class="txt4">
                    <th class="th" style="background-color: #ACACAD;">Tipo</th>
                    <th class="th" style="background-color: #ACACAD;">Nombre del usuario</th>
                    <th class="th" style="background-color: #ACACAD;">Apellido del usuario</th>
                    <th class="th" style="background-color: #ACACAD;">Cédula del usuario</th>
                    <th class="th" style="background-color: #ACACAD;">Teléfono</th>
                    <th class="th" style="background-color: #ACACAD;">Contraseña</th>
                    <th class="th" style="background-color: #ACACAD;">Habilitado</th>
                </tr>

            </thead>
            <tbody id="data"></tbody>
        </table>
        <br>
        <a href="agregarEmp.php" style="text-decoration: none; color: black;"><button class="btn12">Agregar un empleado
            </button></a>

        <div id="miModal2" class="modal">
            <div class="modal-contenido">
                <h2>Atención!!</h2>
                <hr>
                <p>¿Está seguro de que quiere eliminar este usuario?</p>
                <div class="modal-botones">
                    <button id="CancelarEliminar" class="btn3">Cancelar</button>
                    <button id="ConfirmarEliminar" class="btn4">Eliminar</button>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    </script>
    <script type="text/javascript" src="empleados.js"></script>

</body>

</html>