<?php
    require_once('../Negocio/gestionTorneosReglasNegocio.php');

    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: loginVista.php");
    }
    
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $gestionBL = new GestionTorneosReglasNegocio();
        $datosTorneo = $gestionBL->insertarTorneo($_POST['nombre'],$_POST['fecha'],$_POST['estado'],$_POST['ganador']);
        $idUltimo = $gestionBL->obtenerTorneoReciente();
        $torneo = $gestionBL->insertarPartidaCuartos($idUltimo[0][0]);
        header('Location: torneosVistaAdmin.php');
    }
?>
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Crear torneo</title>
    <?php
        echo "<link rel='stylesheet' href='../../css/gestionTorneosVistaCrear.css'>";

    ?>
</head>
<body>
    <?php
        echo "
            <div id='contenedor'>
                <div id='central'>
                    <div id='inicio'>
                        <div class='titulo'>Creación de torneo</div>
                        <form method = 'POST' action = '".htmlspecialchars($_SERVER['PHP_SELF'])."'>
                        <h3>creacion de un torneo</h3>
                            <input name = 'nombre' type = 'text' placeholder='Nombre' required>
                            <input name='fecha' type = 'date' required>
                            <select name='estado'>
                                <option selected='true' disabled='disabled'>Estado del torneo</option>
                                <option value='Encurso'>En curso</option>
                            </select>
                            
                            <input type = 'submit'>
                        </form>
                        <a class='volver' href='torneosVistaAdmin.php'>Volver</a>";                    
                            if(isset($error)) {
                                print('<div class="pie">Completa los datos correctamente.</div>');
                            }                                  
        echo "      </div>
                </div>
            </div>";
    ?>    
</body>
</html>