<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    require("../Infraestructura/gestionTorneosAccesoDatos.php");
    
    class GestionTorneosReglasNegocio {
        
        private $_IdPartido;
        private $_IdTorneo;
        private $_fase;
        private $_IdJugadorA;
        private $_IdJugadorB;
        private $_ganador;
        private $_nombreJugador;

        function __construct() {
        }

        function init($idPartido, $idTorneo, $fase, $idJugadorA, $idJugadorB, $ganador) {
            $this->_IdPartido = $idPartido;
            $this->_IdTorneo = $idTorneo;
            $this->_fase = $fase;
            $this->_IdJugadorA = $idJugadorA;
            $this->_IdJugadorB = $idJugadorB;
            $this->_ganador = $ganador;
        }

        function init2($nombreJugador){
            $this->_nombreJugador = $nombreJugador;
        }

        function getIdPartido(){
            return $this->_IdPartido;
        }
        function getIdTorneo(){
            return $this->_IdTorneo;
        }
        function getFase(){
            return $this->_fase;
        }
        function getIdJugadorA(){
            return $this->_IdJugadorA;
        }
        function getIdJugadorB(){
            return $this->_IdJugadorB;
        }
        function getGanador(){
           return $this->_ganador;
        }
        function getNombreJugador(){
            return $this->_nombreJugador;
        }

        function insertarTorneo($nombre, $fecha, $estado, $ganador) {
            $gestionDAL = new GestionTorneosAccesoDatos();
            $res = $gestionDAL->insertarTorneo($nombre,$fecha, $estado, $ganador);
                   
            return $res;         
        }

        function obtenerPartidos($idTorneo){
            $gestionDAL = new GestionTorneosAccesoDatos();
            $res = $gestionDAL->obtenerPartidos($idTorneo);
            $listaPartidos = array();

            foreach ($res as $partidos) {
                $oPartidosReglasNegocio = new GestionTorneosReglasNegocio();
                $oPartidosReglasNegocio->init($partidos['idPartido'], $partidos['idTorneo'], $partidos['fase'], $partidos['idJugadorA'], $partidos['idJugadorB'], $partidos['ganador']);
                array_push($listaPartidos,$oPartidosReglasNegocio);            
            }            
            return $listaPartidos;
        }

        function obtenerJugadores(){
            $gestionDAL = new GestionTorneosAccesoDatos();
            $res = $gestionDAL->obtenerJugadores();
            $listaJugadores = array();

            foreach($res as $jugador){
                $oJugadoresReglasNegocio = new GestionTorneosReglasNegocio();
                $oJugadoresReglasNegocio->init2($jugador['nombre']);
                array_push($listaJugadores, $oJugadoresReglasNegocio);
            }
            return $listaJugadores;
        }

        function obtenerTorneoReciente(){
            $gestionDAL = new GestionTorneosAccesoDatos();
            $res = $gestionDAL->obtenerTorneoReciente();
     
            return $res;
        }

        function insertarPartidaCuartos($idTorneo){
            $gestionDAL = new GestionTorneosAccesoDatos();
            $gestionDAL->insertarPartidaCuartos($idTorneo);
            
            return $gestionDAL;
            
        }

        function insertarPartida($idTorneo, $idJugadorA, $idJugadorB, $fase, $idGanador){
            $foo = new GestionTorneosAccesoDatos();
            $u = $foo->insertarPartida($idTorneo, $idJugadorA, $idJugadorB, $fase, $idGanador);
            return $u;
        }

        function borrarPartido($idPartido){            
            $partidosDAL = new gestionTorneosAccesoDatos();
            $res = $partidosDAL->borrarPartido($idPartido);           
            return $res;
        }

        function modificarPartida($idPartido, $idJugadorA, $idJugadorB, $fase, $idGanador){
            $foo = new GestionTorneosAccesoDatos();
            $u = $foo->modificarPartida($idPartido, $idJugadorA, $idJugadorB, $fase,$idGanador);
            return $u;
        }
    }