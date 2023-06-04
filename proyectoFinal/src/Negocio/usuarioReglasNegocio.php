<?php
    require("../Infraestructura/usuarioAccesoDatos.php");

    class UsuarioReglasNegocio {
        function __construct() {
        }
        function verificar($usuario, $clave) {
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->verificar($usuario,$clave);           
            return $res;            
        }

        function insertar($usuario, $clave, $perfil){
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->insertar($usuario,$clave,$perfil);
            return $res;
        }

        function insertarCliente($nombre, $email, $birthdate, $phone, $address, $tarjeta, $caducidad, $pin){
            $usuariosDAL = new UsuarioAccesoDatos();
            $res = $usuariosDAL->insertarCliente($nombre, $email, $birthdate, $phone, $address, $tarjeta, $caducidad, $pin);
            return $res;
        }
    }