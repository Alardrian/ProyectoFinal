<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    require("../Infraestructura/jugadorAccesoDatos.php");

    class JugadorReglasNegocio {
        private $_ID;
        private $_nombre;
        private $_totalPartidos;
        private $_partidosGanados;
        private $_totalTorneos;
        private $_torneosGanados;

        function __construct() {
        }

        function init($idJugador, $nombre, $totalPartidos, $partidosGanados, $totalTorneos, $torneosGanados) {
            $this->_ID = $idJugador;
            $this->_nombre = $nombre;
            $this->_totalPartidos = $totalPartidos;
            $this->_partidosGanados = $partidosGanados;
            $this->_totalTorneos = $totalTorneos;
            $this->_torneosGanados = $torneosGanados;
        }
        
        function getID() {
            return $this->_ID;
        }
        function getNombre() {
            return $this->_nombre;
        }
        function getTotalPartidos() {
            return $this->_totalPartidos;
        }
        function getPartidosGanados() {
            return $this->_partidosGanados;
        }
        function getTotalTorneos() {
            return $this->_totalTorneos;
        }
        function getTorneosGanados() {
            return $this->_torneosGanados;
        }

        function obtenerFicha($idJugador) {
            $torneosDAL = new JugadorAccesoDatos();
            $results = $torneosDAL->obtenerFicha($idJugador);
            $listaJugador = array();

            foreach ($results as $jugador) {
                $oJugadorReglasNegocio = new JugadorReglasNegocio();
                $oJugadorReglasNegocio->init($jugador['idJugador'], $jugador['nombre'], $jugador['totalPartidos'], $jugador['partidosGanados'], $jugador['totalTorneos'], $jugador['torneosGanados']);
                array_push($listaJugador,$oJugadorReglasNegocio);            
            }            
            return $listaJugador;
        }

    }