<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
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
<table class="navbar">
        <tr>
            <td width="50px"></td>
            <td width="10%">
                <a href="inicio.php" title="Volver al inicio"><img src="img/Remises pocitos.png" alt="" class="img1"></a>
            </td>
            <td>
            <div class="dropdown" title="Expandir">
                    <button class="dropdown-toggle"><img src="img/hamburguesa.png" alt="" class="img2"></button>
                    <ul class="dropdown-menu">
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
                </div>
                <script src="js/hamburguesa2.js"></script>
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
                <a href="editar_perfilAdm.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="index.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>

    <div class="contenedor">
        <div>
            <div class="cardPerfil2">
                <img src="img/Perfil.png" class="imgPerfil2">
            </div>

        </div>
        <div class="card1">
            <form method="post" action="edtPerfil.php">
                <br><br><br>
                <p class="txt1">
                    <label class="lebel">Nombre del usuario</label>
                    <br><br>
                    <input type="text" id="nom_usu" name="nom_usu" title="Nombre" class="input1" placeholder="Nombre..."
                        maxlength="10" required />
                    <br><br>
                    <label class="lebel">Apellido del usuario</label>
                    <br><br>
                    <input type="text" id="apellido" name="apellido" title="Apellido" class="input1"
                        placeholder="Apellido..." maxlength="10" required />
                    <br><br>
                    <label class="lebel">Teléfono</label>
                    <br><br>
                    <input type="text" id="tel" name="tel" title="Teléfono" class="input1" maxlength="11"
                        placeholder="xxx-xxx-xxx" oninput="formatoTelefono(this)" required />
                    <br><br><br><br><br>
                    <input type="submit" value="Guardar" class="btn6" id="mostrarModal1">
                </p>
            </form>
        </div>
    </div>

    <script src="js/formatotel.js"></script>

    <div id="miModal1" class="modal1">
        <div class="modal-contenido1">
            <h2>Atención!!</h2>
            <hr>
            <p>¿Esta seguro de que quiere guardar los cambios?</p>
            <div class="modal-botones1">
                <a href="editar_perfilAdm.php" class="btn5"><button id="Cancelar" class="btn3">Cancelar</button></a>
                <a href="logout.php" class="btn5"><button id="Salir" class="btn4">Salir</button></a>
            </div>
        </div>
    </div>
    <script src="js/script_salir.js"></script>
    <script src="js/script_guardar.js"></script>


</body>

</html>