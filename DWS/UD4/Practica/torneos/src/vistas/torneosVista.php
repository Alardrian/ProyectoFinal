<!doctype html>
<html>
<head>

</head>

<body>
    <h1> Listado de torneos </h1>
    <?php
        require("../negocio/torneosReglasNegocio.php");

        $torneosBL = new TorneosReglasNegocio();
        $datosTorneos = $torneosBL->obtener();
        
        foreach ($datosTorneos as $torneo)
        {
            echo "<div>";
            print($torneo->getID());
            print($torneo->getNombre());
            print($torneo->getNumJugadores());
            echo "</div>";
        }
    ?>
</body>

</html>