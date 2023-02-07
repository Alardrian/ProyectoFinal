<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    class TorneosAccesoDatos {        
        function __construct() {
        }

        function obtenerTorneos() {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }

            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT idTorneo, nombre, numJugadores, fecha, estado, campeon FROM T_Torneo;");
            $consulta->execute();
            $result = $consulta->get_result();
            $torneos =  array();

            while ($myrow = $result->fetch_assoc()) {
                array_push($torneos, $myrow);
            }
            return $torneos;
        }

        function obtenerNombreTorneo($idTorneo) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "SELECT nombre FROM T_Torneo WHERE idTorneo = (?);");  
            $consulta->bind_param("i", $idTorneo);
            $res = $consulta->execute();
            
            return $res;
        }
        

        function borrarTorneo($idTorneo) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error al conectar a MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'torneosTenisMesa');
            $consulta = mysqli_prepare($conexion, "DELETE FROM T_Torneo WHERE idTorneo = (?);");  
            $consulta->bind_param("i", $idTorneo);
            $res = $consulta->execute();
            
            return $res;
        }
    }