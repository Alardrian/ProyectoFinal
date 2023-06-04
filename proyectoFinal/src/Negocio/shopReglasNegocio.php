<?php
    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    require("../Infraestructura/shopAccesoDatos.php");

    class ShopReglasNegocio {
        private $_ID_VEHICULO;
        private $_ID_TIPO_DE_VEHICULO;
        private $_MARCA;
        private $_MODELO;
        private $_ANIO;
        private $_CAPACIDAD;
        private $_PRECIO_DIA;

        function __construct() {
        }

        function init($id_vehiculo, $id_tipo_de_vehiculo, $marca, $modelo, $anio, $capacidad, $precio_dia) {
            $this->_ID_VEHICULO = $id_vehiculo;
            $this->_ID_TIPO_DE_VEHICULO = $id_tipo_de_vehiculo;
            $this->_MARCA = $marca;
            $this->_MODELO = $modelo;
            $this->_ANIO = $anio;
            $this->_CAPACIDAD = $capacidad;
            $this->_PRECIO_DIA = $precio_dia;
        }
        
        function getIDVehiculo() {
            return $this->_ID_VEHICULO;
        }
        function getIDTipo_de_vehiculo() {
            return $this->_ID_TIPO_DE_VEHICULO;
        }
        function getMarca() {
            return $this->_MARCA;
        }
        function getModelo() {
            return $this->_MODELO;
        }
        function getAnio() {
            return $this->_ANIO;
        }
        function getCapacidad() {
            return $this->_CAPACIDAD;
        }
        function getPrecio() {
            return $this->_PRECIO_DIA;
        }

        function obtenerCoches($tipo_vehiculo) {
            $cochesDAL = new shopAccesoDatos();
            $results = $cochesDAL->obtenerCoches($tipo_vehiculo);
            $listaCoches =  array();

            foreach ($results as $coches) {
                $oShopReglasNegocio = new ShopReglasNegocio();
                $oShopReglasNegocio->init($coches['id_vehiculo'], $coches['id_tipo_de_vehiculo'], $coches['marca'], $coches['modelo'], $coches['anio'], $coches['capacidad'],$coches['precio_dia']);
                array_push($listaCoches,$oShopReglasNegocio);            
            }            
            return $listaCoches;
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

        function insertarReserva($usuario, $id_vehiculo, $fecha_inicio, $fecha_fin, $costo_diario){
            $cochesDAL = new ShopAccesoDatos();
            $res = $cochesDAL->insertarReserva($usuario, $id_vehiculo, $fecha_inicio, $fecha_fin, $costo_diario);
            return $res;
        }

        function insertarFactura($costo_diario, $intervalo_dias){
            $impuestos = 21;
            $fecha_de_emision = date("Y-m-d");
            $subtotal = $costo_diario * $intervalo_dias;
            $total = $subtotal + $subtotal * ($impuestos/100);

            $cochesDAL = new ShopAccesoDatos();
            $res = $cochesDAL->insertarFactura($fecha_de_emision, $subtotal, $impuestos, $total);
            return $res;
        }
    }