<?php
    require('../Negocio/torneosReglasNegocio.php');
    require('../Negocio/gestionTorneosReglasNegocio.php');

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $gestionBL = new GestionTorneosReglasNegocio();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos</title>
    <link rel="stylesheet" href="../../css/torneosVistaAdmin.css">
</head>
<body>
    <?php
        ini_set('display_errors', 'On');
        ini_set('html_errors', 1);

        require_once("../Negocio/torneosReglasNegocio.php");

        $torneosBL = new TorneosReglasNegocio();
        $datosTorneos = $torneosBL->obtenerTorneos();
                    
        echo "
            <div>
                <div class='usuario'>Bienvenido: ".$_SESSION['usuario']." <br><a href='logOutVista.php'> Cerrar sesion </a></div>
                <div class='crear'><a href='crearTorneosVista.php'>Crear torneo</a></div>                                              
                <div class='registros'><p>Numero de registros: ".count($datosTorneos)."</p></div>
                    </div>
                    <div>
                        <table>
                            <caption>Torneos de Tenis de Mesa</caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre torneo</th>
                                    <th>Numero jugadores</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Campeon</th>
                                    
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($datosTorneos as $torneos){
            echo "
                <tr>
                    <td>".$torneos->getID()."</td>
                    <td>".$torneos->getNombre()."</td>
                    <td>".$torneos->getNumJugadores()."</td>
                    <td>".$torneos->getFecha()."</td>
                    <td>".$torneos->getEstado()."</td>
                    <td>".$torneos->getCampeon()."</td>
                    <td><a href='gestionTorneosVista.php?idTorneo=".$torneos->getID()."'>Editar</a></td>
                    <td><a href='mensajeBorrarTorneoVista.php?idTorneo=".$torneos->getID()."'>Borrar</a></td>
                 </tr>";
        }
        echo " </tbody>
            </table>
            </div>";
    ?>
</body>
</html>