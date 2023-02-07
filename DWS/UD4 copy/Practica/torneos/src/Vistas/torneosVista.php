<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Torneo</title>
    <link rel='stylesheet' href='../../css/torneosVista.css'>
</head>
<body>

    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: loginVista.php");
        }
        require("../Negocio/gestionTorneosReglasNegocio.php");
        require("../Negocio/torneosReglasNegocio.php");
        ini_set('display_errors', 'On');
        ini_set('html_errors', 1);

        $idTorneo = $_GET['idTorneo'];
        $nombreTorneo = $_GET['nombreTorneo'];
        $jugadoresBL = new GestionTorneosReglasNegocio();
        $datosPartidos = $jugadoresBL->obtenerPartidos($idTorneo);
 

        echo"
        <h1>".$nombreTorneo."</h1>
        <article id='container'>
        <section>";

        foreach($datosPartidos as $partido){
            if($partido->getFase() == "Cuartos"){
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorA()."'>".$partido->getIdJugadorA()."</a></div>";
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorB()."'>".$partido->getIdJugadorB()."</a></div>";
            }
            
        }
        echo"
        </section>
        <div class='connecter'>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class='line'>
            <div>
            </div><div>
            </div><div>
            </div><div>
            </div>
        </div>
        <section id='quarterFinals'>";
        foreach($datosPartidos as $partido){
            if($partido->getFase() == "Semifinales"){
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorA()."'>".$partido->getIdJugadorA()."</a></div>";
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorB()."'>".$partido->getIdJugadorB()."</a></div>";
            }
        }
        echo"
        </section>
        <div class='connecter' id='conn2'>
            <div></div>
            <div></div>
        </div>
        <div class='line' id='line2'>
            <div></div>
            <div></div>
        </div>
        <section id='semiFinals'>";
        foreach($datosPartidos as $partido){
            if($partido->getFase() == "Final"){
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorA()."'>".$partido->getIdJugadorA()."</a></div>";
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getIdJugadorB()."'>".$partido->getIdJugadorB()."</a></div>";
            }
        }
        echo"
        </section>
        <div class='connecter' id='conn3'>
            <div></div>
        </div>
        <div class='line' id='line3'>
            <div></div>
        </div>
        <section id='final'>";
        foreach($datosPartidos as $partido){
            if($partido->getFase() == "Final"){
                echo "<div><a href='fichaJugadorVista.php?idJugador=".$partido->getGanador()."'>".$partido->getGanador()."</a></div>";
            }
        }
        echo"
        </section>
        </article>;"
    ?>    
</body>
</html>