<?php

require("accesoDatos/usuarioAccesoDatos.php");

function test_alta_usuario()
{
    $u = new UsuarioAccesoDatos();
    return $u->insertar('alex','jugador','passwordalex');
}

function test_verificar_usuario_encontrado()
{
    $perfil_esperado = 'jugador';
    $u = new UsuarioAccesoDatos();
    $perfil = $u->verificar('alex','passwordalex');
    return $perfil === $perfil_esperado;
}

var_dump(test_alta_usuario());
var_dump(test_verificar_usuario_encontrado());