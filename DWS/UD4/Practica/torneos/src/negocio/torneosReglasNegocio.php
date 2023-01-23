<?php

// AQUI NO VAN NI SELECTS DE BASE DATOS NI HTML.

require("../infraestructura/torneosAccesoDatos.php");

class TorneosReglasNegocio
{
    private $_ID;
    private $_nombre;
    private $_num_jugadores;

	function __construct()
    {
    }

    function init($id,$nombre,$num_jugadores)
    {
        $this->_ID = $id;
        $this->_nombre = $nombre;
        $this->_num_jugadores = $num_jugadores;
    }

    function getID()
    {
        return $this->_ID;
    }
    
    function getNombre()
    {
        return $this->_nombre;
    }

    function getNumJugadores()
    {
        return $this->_num_jugadores;
    }

    function obtener()
    {
        
        $torneosDAL = new TorneosAccesoDatos();
        $rs = $torneosDAL->obtener();

		$listaTorneos = array();

        foreach ($rs as $torneo)
        {
            $oTorneosReglasNegocio = new TorneosReglasNegocio();
            $oTorneosReglasNegocio->init($torneo['ID'],$torneo["nombre"],$torneo["num_jugadores"]);
            array_push($listaTorneos,$oTorneosReglasNegocio);
         
        }
        
        return $listaTorneos;
        
    }
}