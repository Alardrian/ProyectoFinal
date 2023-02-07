<?php

    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    class GestionTorneosAccesoDatos {	

        function __construct() {
        }

        function insertarTorneo($nombre, $fecha, $estado, $ganador) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            $numJugadores = 8;            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "INSERT INTO T_Torneo(nombre,numJugadores,fecha,estado,campeon) VALUES (?,?,?,?,?);");
            $consulta2 = mysqli_prepare($conexion, "UPDATE T_Jugador set totalTorneos = totalTorneos+1 WHERE idJugador IN (1,2,3,4,5,6,7,8);");  
            $consulta->bind_param("sisss", $nombre, $numJugadores, $fecha, $estado, $ganador);
            $consulta2->execute();
            $res = $consulta->execute();            
            return $res;
        }

        function obtenerJugadores(){
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT nombre FROM T_Jugador;");  
            $consulta->execute();            
            $result = $consulta->get_result();
            $jugadores = array();

            while ($myrow = $result->fetch_assoc()) {
                array_push($jugadores, $myrow);
            }
            return $jugadores;
        }
        
        function obtenerTorneoReciente(){
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
           
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT MAX(idTorneo) FROM T_Torneo");
            $consulta->execute();
            $res = $consulta->get_result();
            
            $result = array();
            while ($myrow = $res->fetch_row()) {
                array_push($result, $myrow);
            }
            return $result;
        }

        function insertarPartidaCuartos($idTorneo) {
           
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'torneosTenisMesa');

            $partidos = [1,2,3,4,5,6,7,8,];
            $fase = "Cuartos";
            $cuatro = 4;
            for ($i=0; $i < 4; $i++) { 
                $random = random_int(1,2);
                if ($random == 1){
                    $ganador = $i;
                }else{
                    $ganador = $cuatro;
                }
                $consulta = mysqli_prepare($conexion, "INSERT INTO T_Partidos (idTorneo, fase, idJugadorA, idJugadorB, ganador) VALUES (?,?,?,?,?);");
                $consulta2 = mysqli_prepare($conexion, "UPDATE T_Jugador set partidosGanados = partidosGanados+1 WHERE idJugador = (?);"); 
                $consulta3 = mysqli_prepare($conexion, "UPDATE T_Jugador set totalPartidos = totalPartidos+1 WHERE idJugador IN ((?),(?));"); 
                $consulta->bind_param("isiii", $idTorneo, $fase, $partidos[$i], $partidos[$cuatro], $partidos[$ganador]);
                $consulta2->bind_param("i",$partidos[$ganador]);
                $consulta3->bind_param("ii",$partidos[$i],$partidos[$cuatro]);
                $cuatro++;
                $consulta2->execute();
                $consulta3->execute();
                $res = $consulta->execute();
            }
            return $res;
        }


        function insertarPartida($idTorneo, $idJugadorA, $idJugadorB, $fase, $idGanador) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'torneosTenisMesa');
            if($fase == "Final"){
                $estado = "Finalizado";
                $consulta4 = mysqli_prepare($conexion, "UPDATE T_Jugador set torneosGanados = torneosGanados+1 WHERE idJugador = (?);");
                $consulta5 = mysqli_prepare($conexion, "UPDATE T_Torneo set estado = (?) WHERE idTorneo = (?);");
                $consulta6 = mysqli_prepare($conexion, "UPDATE T_Torneo set campeon = (?) WHERE idTorneo = (?);");
                $consulta4->bind_param("i",$idGanador);
                $consulta5->bind_param("si",$estado,$idTorneo);
                $consulta6->bind_param("ii",$idGanador,$idTorneo);
                $consulta4->execute();
                $consulta5->execute();
                $consulta6->execute();
            }
            $consulta = mysqli_prepare($conexion, "INSERT INTO T_Partidos (idTorneo, fase, idJugadorA, idJugadorB, ganador) VALUES (?,?,?,?,?);");
            $consulta2 = mysqli_prepare($conexion, "UPDATE T_Jugador set partidosGanados = partidosGanados+1 WHERE idJugador = (?);");
            $consulta3 = mysqli_prepare($conexion, "UPDATE T_Jugador set totalPartidos = totalPartidos+1 WHERE idJugador IN ((?),(?));");
            $consulta->bind_param("isiii", $idTorneo,$fase, $idJugadorA, $idJugadorB,  $idGanador);
            $consulta2->bind_param("i",$idGanador);
            $consulta3->bind_param("ii",$idJugadorA,$idJugadorB);
            $consulta->execute();
            $consulta2->execute();
            $consulta3->execute();
            $result = $consulta->get_result();
            return $result;
        }

        function modificarPartida($idPartido, $idJugadorA, $idJugadorB, $fase, $idGanador) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "UPDATE T_Partidos SET fase = (?), idJugadorA = (?), idJugadorB = (?), ganador = (?) WHERE idPartido = (?);");
            $consulta->bind_param("siiii", $fase, $idJugadorA, $idJugadorB, $idGanador, $idPartido);
            $consulta->execute();
            $result = $consulta->get_result();
            return $result;
        }

        function obtenerPartidos($idTorneo){
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT idPartido, idTorneo, fase, idJugadorA, idJugadorB, ganador FROM T_Partidos WHERE idTorneo = (?);");
            $consulta->bind_param("i", $idTorneo); 
            $consulta->execute();
            $result = $consulta->get_result();
            $partidos = array();

            while ($myrow = $result->fetch_assoc()) {
                array_push($partidos, $myrow);
            }
            return $partidos;
        }

        function borrarPartido($idPartido) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "DELETE FROM T_Partidos WHERE idPartido = (?);");  
            $consulta->bind_param("i", $idPartido);
            $res = $consulta->execute();
            
            return $res;
        }
    }