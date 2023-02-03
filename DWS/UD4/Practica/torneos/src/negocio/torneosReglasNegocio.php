<?php

// AQUI NO VAN NI SELECTS DE BASE DATOS NI HTML.

require("../accesoDatos/torneosAccesoDatos.php");

class TorneosReglasNegocio
{
    private $_ID;
    private $_nombre;
    private $_num_jugadores;
    private $_date;

	function __construct()
    {
    }

    function init($id,$nombre,$num_jugadores,$_date)
    {
        $this->_ID = $id;
        $this->_nombre = $nombre;
        $this->_num_jugadores = $num_jugadores;
        $this->_date;
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
    
    function getDate()
    {
        return $this->_date;
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