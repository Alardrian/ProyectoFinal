<?php
    require_once('../Negocio/gestionTorneosReglasNegocio.php');

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $gestionBL = new GestionTorneosReglasNegocio();
        $datosTorneo =  $gestionBL->insertarTorneo($_POST['nombre'],$_POST['fecha'],$_POST['estado'],$_POST['ganador']);
        $ultimoTorneo = $gestionBL->obtenerTorneoReciente();
        $insertarCuartos = $gestionBL->insertarPartidaCuartos($ultimoTorneo);
        header('Location: torneosVistaAdmin.php');
    }
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Insertar torneo</title>
    <?php
        echo "<link rel='stylesheet' href='../../css/gestionTorneosVistaEditar.css'>";
        
    ?>
</head>
<body>
    <?php
        $idTorneo = $_GET['idTorneo'];
        $gestionBL = new GestionTorneosReglasNegocio();
        $datosPartidos =  $gestionBL->obtenerPartidos($idTorneo);
        echo "
            <div ='contenedor'>
                <div></div>                        
                <div class='usuario'><p>Bienvenido: ".$_SESSION['usuario']."<br><a href='logOutVista.php'>Cerrar sesion</a></p></div>
                <div class='volver'><a href='torneosVistaAdmin.php'>Volver</a></div>
                <div class='registros'><p>Numero de registros:".count($datosPartidos)."</p></div>
                <div class='crear'><a href='crearPartidoVista.php?idTorneo=".$idTorneo."'>Nueva partida</a></div>
                </div>
                    <div>
                        <table class='default'>
                            <caption>Torneos de Tenis de Mesa</caption>
                            <thead>
                                <tr>
                                    <th>ID del Partido</th>
                                    <th>Jugador A</th>
                                    <th>Jugador B</th>
                                    <th>Ronda</th>
                                    <th>Ganador</th>
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($datosPartidos as $partidos){
            echo "
                <tr>
                    <td>".$partidos->getIdPartido()."</td>
                    <td>".$partidos->getIdJugadorA()."</td>
                    <td>".$partidos->getIdJugadorB()."</td>
                    <td>".$partidos->getFase()."</td>
                    <td>".$partidos->getGanador()."</td>
                    <td><a href='editarPartidosVista.php?idPartido=".$partidos->getIdPartido()."'>Editar</a></td>
                    <td><a href='mensajeBorrarPartidoVista.php?idPartido=".$partidos->getIdPartido()."'>Borrar</a></td>
                </tr>";
        }
        echo "</tbody>
                </table>
                    </div>
                </div>
            </div>";
    ?>    
</body>
</html>