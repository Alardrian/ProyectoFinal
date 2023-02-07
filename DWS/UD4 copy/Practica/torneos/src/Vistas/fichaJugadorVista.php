<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Ficha jugador</title>
    <link rel='stylesheet' href='../../css/fichaJugadorVista.css'>
</head>
<body>

    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: loginVista.php");
        }
        require("../Negocio/jugadorReglasNegocio.php");
        ini_set('display_errors', 'On');
        ini_set('html_errors', 1);

        $idJugador = $_GET['idJugador'];
        $jugadorBL = new JugadorReglasNegocio();
        $datosJugador = $jugadorBL->obtenerFicha($idJugador);

        echo"
        <h1>Ficha del jugador ".$idJugador."</h1>";
        foreach($datosJugador as $jugador){
                $porcentajeVictorias = ($jugador->getPartidosGanados()/$jugador->getTotalPartidos())*100;

                echo "<div>ID: ".$jugador->getID()."</div>";
                echo "<div>Nombre: ".$jugador->getNombre()."</div>";
                echo "<div>Total partidos: ".$jugador->getTotalPartidos()."</div>";
                echo "<div>Partidos ganados: ".$jugador->getPartidosGanados()."</div>";
                echo "<div>Porcentaje victorias:".$porcentajeVictorias."</div>";
                echo "<div>Total torneos: ".$jugador->getTotalTorneos()."</div>";
                echo "<div>Torneos ganados: ".$jugador->getTorneosGanados()."</div>";
                echo "<div><a href='torneosVistaJugador.php'>Volver atras</a></div>";
            }
    ?>    
</body>
</html>