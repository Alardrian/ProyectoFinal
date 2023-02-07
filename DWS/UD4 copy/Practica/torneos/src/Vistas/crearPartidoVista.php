<?php
    require ("../Negocio/gestionTorneosReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {

        if(($_POST['idJugadorA'] != null) && ($_POST['idJugadorB'] != null) && ($_POST['fase'] != null) && ($_POST['idGanador'] != null)){
            $foo = new GestionTorneosReglasNegocio();
            $u = $foo->insertarPartida($_POST['idTorneo'], $_POST['idJugadorA'], $_POST['idJugadorB'], $_POST['fase'], $_POST['idGanador']);
            header("Location: torneosVistaAdmin.php");
        } else{
            $error = true;
        }
    }else{
        $idTorneo = $_GET['idTorneo'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Partida</title>
    <link rel="stylesheet" href="../../css/resultadoPartidaVista.css">
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: loginVista.php");
        }

        echo "
            <div id='contenedor'>
                <div id='central'>
                    <div id='inicio'>
                        
                        <form method = 'POST' action = '".htmlspecialchars($_SERVER['PHP_SELF'])."'>
                        <h3>Resultados del partido</h3>
                            <select name='idJugadorA' id='jugador'>
                                <option selected='true' disabled='disabled'>Jugador A</option>
                                <option value='1'>Jugador1</option>
                                <option value='2'>Jugador2</option>
                                <option value='3'>Jugador3</option>
                                <option value='4'>Jugador4</option>
                                <option value='5'>Jugador5</option>
                                <option value='6'>Jugador6</option>
                                <option value='7'>Jugador7</option>
                                <option value='8'>Jugador8</option>
                            </select>
                            <select name='idJugadorB' id='jugador'>
                                <option selected='true' disabled='disabled'>Jugador B</option>
                                <option value='1'>Jugador1</option>
                                <option value='2'>Jugador2</option>
                                <option value='3'>Jugador3</option>
                                <option value='4'>Jugador4</option>
                                <option value='5'>Jugador5</option>
                                <option value='6'>Jugador6</option>
                                <option value='7'>Jugador7</option>
                                <option value='8'>Jugador8</option>
                            </select>
                            <select name='fase' id='jugador'>
                                <option selected='true' disabled='disabled'>Fase</option>
                                <option value='Semifinales'>Semifinales</option>
                                <option value='Final'>Final</option>
                            </select>
                            <select name='idGanador' id='jugador'>
                                <option selected='true' disabled='disabled'>Ganador</option>
                                <option value='1'>Jugador1</option>
                                <option value='2'>Jugador2</option>
                                <option value='3'>Jugador3</option>
                                <option value='4'>Jugador4</option>
                                <option value='5'>Jugador5</option>
                                <option value='6'>Jugador6</option>
                                <option value='7'>Jugador7</option>
                                <option value='8'>Jugador8</option>
                            </select>
                            <input type='hidden' value='".$idTorneo."' name='idTorneo'>
                            <input class='boton' type ='submit'>
                        </form>
                        <a class='volver' href='gestionTorneosVista.php".$idTorneo."'>Volver</a>";
                        if(isset($error)){
                            print("<div'>Introduce los datos correctamente.</div>");
                        }                                                    
        echo "      </div>
                </div>
            </div>";
    ?>    
</body>
</html>