
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remises pocitos</title>
    <link rel="icon" href="img/Remises pocitos.png">
    <link rel="stylesheet" href="css/inicioAdm.css">
</head>

<body>
<?php
session_start();
error_reporting(0);
$ci = $_SESSION['ci'];
if (!isset($ci)) {
    header("Location: index.php");
    die();
}
?>
    <script src="js/script_salir.js"></script>
    <table class="navbar">
        <tr>
            <td width="50px"></td>
            <td width="10%">
                <a href="inicioAdm.php" title="Volver al inicio"><img src="img/Remises pocitos.png" alt="" class="img1"></a>
            </td>
            <td>
            <div class="dropdown" title="Expandir">
                    <button class="dropdown-toggle"><img src="img/hamburguesa.png" alt="" class="img2"></button>
                    <ul class="dropdown-menu">
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons">Empleados</a>
                            <div id="buttonContainer" class="hidden">
                                <a href="Empleados/ver_emp.php" class="dropdown-op">Ver</a>
                                <a href="Empleados/agregarEmp.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons1">Choferes</a>
                            <div id="buttonContainer1" class="hidden1">
                                <a href="Chofer/ver_chofer.php" class="dropdown-op">Ver</a>
                                <a href="Chofer/agregarChofer.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons2">Clientes</a>
                            <div id="buttonContainer2" class="hidden2">
                                <a href="Cliente/ver_Cli.php" class="dropdown-op">Ver</a>
                                <a href="Cliente/agregarCli.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons3">Viajes</a>
                            <div id="buttonContainer3" class="hidden3">
                                <a href="Viaje/ver_Viajes.php" class="dropdown-op">Ver</a>
                                <a href="Viaje/agregarViajes.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                        <li class="dropdown-op1">
                            <a href="#" id="showButtons4">Coches</a>
                            <div id="buttonContainer4" class="hidden4">
                                <a href="Coche/ver_Coche.php" class="dropdown-op">Ver</a>
                                <a href="#" class="dropdown-op"></a>
                            </div>
                        </li>
                        <li class="dropdown-op2">
                            <a href="#" id="showButtons5">Man. de coches</a>
                            <div id="buttonContainer5" class="hidden5">
                                <a href="Man.coche/ver_ManCoche.php" class="dropdown-op">Ver</a>
                                <a href="Man.coche/agregarManCoche.php" class="dropdown-op">Agregar</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <script src="js/hamburguesa.js"></script>
            </td>
            <td width="1250px"></td>
            <td title="Editar perfil">
                <a href="editar_perfil.php">
                    <div class="cardPerfil">
                        <a href="editar_perfilAdm.php"><img src="img/Perfil.png" class="imgPerfil">
                    </div>
                </a>
            </td>
            <td width="30px"></td>
            <td>
                <button class="btn2" id="mostrarModal">Salir</button>
            </td>
            <td width="50px"></td>
        </tr>
    </table>
    <br><br><br><br>
    <div class="contenedor">
        <a href="#" class="links modal-button" data-modal-id="modal1" title="Empleados">
            <div class="card">
                <img src="img/empleado.png" class="imgEmpleado">
                <p class="txt">Empleado</p>
            </div>
        </a>
        <a href="#" class="links modal-button" data-modal-id="modal2" title="Choferes">
            <div class="card">
                <img src="img/chofer.png" class="imgChofer">
                <p class="txt">Choferes</p>
            </div>
        </a>
        <a href="#" class="links modal-button" data-modal-id="modal3" title="Clientes">
            <div class="card">
                <img src="img/cliente.png" class="imgCliente">
                <p class="txt">Cliente</p>
            </div>
        </a>
        <a href="#" class="links modal-button" data-modal-id="modal4" title="Viajes">
            <div class="card">
                <img src="img/viaje.png" class="imgViaje">
                <p class="txt">Viajes</p>
            </div>
        </a>
        <a href="#" class="links modal-button" data-modal-id="modal5" title="Coches">
            <div class="card">
                <img src="img/coche.png" class="imgCoche">
                <p class="txtCoche">Coches</p>
            </div>
        </a>
        <a href="#" class="links modal-button" data-modal-id="modal6" title="Mantenimiento de coches">
            <div class="card">
                <img src="img/mantenimiento.png" class="imgMan">
                <p class="txtMan">Mantenimiento </p> <br>
                <p class="txtMan1"> de coches</p>
            </div>
        </a>
    </div>
    </div>


    <div id="modal1" class="modal">
        <div class="modal-content3">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Empleados/ver_emp.php"><button id="btn9">Ver empleados</button></a>
            <a href="Empleados/agregarEmp.php"><button id="btn10">Agregar empleado</button></a>
        </div>
    </div>

    <div id="modal2" class="modal">
        <div class="modal-content3">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Chofer/ver_chofer.php"><button id="btn9">Ver Choferes</button></a>
            <a href="Chofer/agregarChofer.php"><button id="btn10">Agregar Chofer</button></a>
        </div>
    </div>

    <div id="modal3" class="modal">
        <div class="modal-content3">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Cliente/ver_Cli.php"><button id="btn9">Ver clientes</button></a>
            <a href="Cliente/agregarCli.php"><button id="btn10">Agregar cliete</button></a>
        </div>
    </div>
    <div id="modal4" class="modal">
        <div class="modal-content3">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Viaje/ver_Viajes.php"><button id="btn9">Ver viajes</button></a>
            <a href="Viaje/agregarViajes.php"><button id="btn10">Agregar viajes</button></a>
        </div>
    </div>

    <div id="modal5" class="modal">
        <div class="modal-content3">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Coche/ver_Coche.php"><button id="btn11">Ver coches</button></a>
        </div>
    </div>

    <div id="modal6" class="modal">
        <div class="modal-content4">
            <span class="close">&times;</span>
            <h2 class="quehacer">¿Qué desea hacer?</h2>
            <hr>
            <a href="Man.coche/ver_ManCoche.php"><button id="btn12">Ver Man. de Coches</button></a>
            <br>
            <a href="Man.coche/agregarManCoche.php"><button id="btn13">Agregar Man. de Coche</button></a>
        </div>
    </div>
    <div id="miModal" class="modal">
        <div class="modal-contenido">
            <h2>¡¡¡Atención!!!</h2>
            <hr>
            <p>¿Está seguro de que quiere salir?</p>
            <div class="modal-botones">
                <a href="inicio.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/ver_agregar.js"></script>
    <script src="js/jquery.min.js"></script>
</body>

</html>
