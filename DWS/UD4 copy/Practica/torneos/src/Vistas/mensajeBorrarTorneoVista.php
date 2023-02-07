<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar torneo</title>
    <link rel="stylesheet" href="../../css/mensajeBorrarTorneoVista.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: loginVista.php");
        }

        require_once("../Negocio/torneosReglasNegocio.php");
        $idTorneo = $_GET['idTorneo'];
        
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $torneosBL = new TorneosReglasNegocio();
            $id =  $torneosBL->borrarTorneo($_POST['idTorneo']);
            header('Location: torneosVistaAdmin.php');
        }

        echo "
        <form method = 'POST' action = '".htmlspecialchars($_SERVER['PHP_SELF'])."'>
        <h3>Confirmación borrado de torneo</h3>
        <input id ='username' type = 'hidden' name = 'idTorneo' value='".$idTorneo."'>
        <input type = 'submit' value='Borrar' id='password'>
        '<a href='torneosVistaAdmin.php'>Cancelar</a> </form>";   
        

            
    ?>
</body>
</html>