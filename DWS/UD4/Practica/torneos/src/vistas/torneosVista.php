<!doctype html>
<html>
<head>

</head>

<body>
    <?php
        session_start(); // reanudamos la sesión
        if (!isset($_SESSION['usuario']))
        {
            header("Location: login.php");
        }
    ?>


    <h1> Listado de torneos </h1>
    <?php echo "Bienvenido: ".$_SESSION['usuario']; ?>
    <br>
    <a href="logout.php"> Cerrar sesión </a>

    <?php
        require("../negocio/torneosReglasNegocio.php");

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