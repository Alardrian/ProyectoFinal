<!doctype html>
<html>
<head>

</head>

<body>
    <h1> Listado de torneos </h1>
    <?php
        require("torneosReglasNegocio.php");

        $torneosBL = new TorneosReglasNegocio();
        $datosTorneos = $torneosBL->obtener();
        
        foreach ($datosTorneos as $torneo)
        {
            echo "<div>";
            print($torneo->getID());
            echo "</div>";
        }
    ?>
</body>

</html>