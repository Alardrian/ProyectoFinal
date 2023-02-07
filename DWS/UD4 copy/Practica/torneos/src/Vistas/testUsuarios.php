
<?php
    require("../Infraestructura/usuarioAccesoDatos.php");
    
    function test_alta_usuario() {
        $u = new UsuarioAccesoDatos();

        $passwd = '12345678';
        $mensajeError = 'La contraseña debe tener 8 caracteres o mas';

        if(strlen($passwd) < 8){
            return $mensajeError;
        } else{
            test_verificar_usuario_encontrado($passwd);
            return $u->insertar('Dani', 'Jugador', $passwd);
        }
    }

    function test_alta_usuario2() {
        $u = new UsuarioAccesoDatos();

        $passwd = '12345678';
        $mensajeError = 'La contraseña debe tener 8 caracteres o mas';

        if(strlen($passwd) < 8){
            return $mensajeError;
        } else{
            test_verificar_usuario_encontrado($passwd);
            return $u->insertar('Alex', 'Administrador', $passwd);
        }
    }

    function test_verificar_usuario_encontrado() {
        $perfil_esperado = 'Jugador';
        $u = new UsuarioAccesoDatos();
        $perfil = $u->verificar('Dani','12345678');
        return $perfil === $perfil_esperado;
    }

    function test_verificar_usuario_encontrado2() {
        $perfil_esperado = 'Administrador';
        $u = new UsuarioAccesoDatos();
        $perfil = $u->verificar('Alex','12345678');
        return $perfil === $perfil_esperado;
    }

    var_dump(test_alta_usuario());
    var_dump(test_verificar_usuario_encontrado());

    var_dump(test_alta_usuario2());
    var_dump(test_verificar_usuario_encontrado2());