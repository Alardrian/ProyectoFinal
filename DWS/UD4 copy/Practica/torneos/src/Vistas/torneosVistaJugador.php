<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneos</title>
    <link rel="stylesheet" href="../../css/torneosVistaJugador.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: loginVista.php");
        }
    ?>

    <?php
        require("../Negocio/torneosReglasNegocio.php");
        ini_set('display_errors', 'On');
        ini_set('html_errors', 1);

        $torneosBL = new TorneosReglasNegocio();
        $datosTorneos = $torneosBL->obtenerTorneos();        
            
        echo "
            <div id='contenedor'>
                <div class='usuario'>Bienvenido: ".$_SESSION['usuario']." <br><a href='logOutVista.php'> Cerrar sesion </a></div>
                <div class='registros'><p>Número de registros: ".count($datosTorneos)."</p></div>
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
                    <td><a href='torneosVista.php?idTorneo=".$torneos->getID()."&nombreTorneo=".$torneos->getNombre()."'>".$torneos->getNombre()."</a></td>
                    <td>".$torneos->getNumJugadores()."</td>
                    <td>".$torneos->getFecha()."</td>
                    <td>".$torneos->getEstado()."</td>
                    <td>".$torneos->getCampeon()."</td>
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