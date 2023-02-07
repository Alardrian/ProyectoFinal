<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);
    class JugadorAccesoDatos {	
        function __construct() {
        }

        function obtenerFicha($idJugador){
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT idJugador, nombre, totalPartidos, partidosGanados, totalTorneos, torneosGanados FROM T_Jugador WHERE idJugador = (?);");
            $consulta->bind_param("i",$idJugador);
            $consulta->execute();            
            $result = $consulta->get_result();
            return $result;
        }
    }