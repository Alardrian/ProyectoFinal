<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    require("../Infraestructura/torneosAccesoDatos.php");

    class TorneosReglasNegocio {
        private $_ID;
        private $_nombre;
        private $_numJugadores;
        private $_fecha;
        private $_estado;
        private $_campeon;

        function __construct() {
        }

        function init($id, $nombre, $numJugadores, $fecha, $estado, $campeon) {
            $this->_ID = $id;
            $this->_nombre = $nombre;
            $this->_numJugadores = $numJugadores;
            $this->_fecha = $fecha;
            $this->_estado = $estado;
            $this->_campeon = $campeon;
        }
        
        function getID() {
            return $this->_ID;
        }
        function getNombre() {
            return $this->_nombre;
        }
        function getNumJugadores() {
            return $this->_numJugadores;
        }
        function getFecha() {
            return $this->_fecha;
        }
        function getEstado() {
            return $this->_estado;
        }
        function getCampeon() {
            return $this->_campeon;
        }

        function obtenerTorneos() {
            $torneosDAL = new TorneosAccesoDatos();
            $results = $torneosDAL->obtenerTorneos();
            $listaTorneos =  array();

            foreach ($results as $torneos) {
                $oTorneosReglasNegocio = new TorneosReglasNegocio();
                $oTorneosReglasNegocio->init($torneos['idTorneo'], $torneos['nombre'], $torneos['numJugadores'], $torneos['fecha'], $torneos['estado'], $torneos['campeon']);
                array_push($listaTorneos,$oTorneosReglasNegocio);            
            }            
            return $listaTorneos;
        }

        function obtenerNombreTorneo($idTorneo){
            $torneosDAL = new TorneosAccesoDatos();
            $result = $torneosDAL->obtenerNombreTorneo($idTorneo);
            return $result;
        }

        function borrarTorneo($idTorneo){            
            $torneosDAL = new TorneosAccesoDatos();
            $res = $torneosDAL->borrarTorneo($idTorneo);           
            return $res;
        }
    }