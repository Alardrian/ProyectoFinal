<?php

// AQUI NO VAN NI SELECTS DE BASE DATOS NI HTML.

require("torneosAccesoDatos.php");

class TorneosReglasNegocio
{
    private $_ID;

	function __construct()
    {
    }

    function init($id)
    {
        $this->_ID = $id;
    }

    function getID()
    {
        return $this->_ID;
    }

    function obtener()
    {
        
        $torneosDAL = new TorneosAccesoDatos();
        $rs = $torneosDAL->obtener();

		$listaTorneos = array();

        foreach ($rs as $torneo)
        {
            $oTorneosReglasNegocio = new TorneosReglasNegocio();
            $oTorneosReglasNegocio->init($torneo['ID']);
            array_push($listaTorneos,$oTorneosReglasNegocio);
         
        }
        
        return $listaTorneos;
        
    }
}