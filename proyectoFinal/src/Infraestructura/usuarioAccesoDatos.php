<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);
class UsuarioAccesoDatos
{
    function __construct()
    {
    }

    function insertar($usuario, $clave, $perfil)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($conexion, 'alquiler_de_coches');
        $consulta = mysqli_prepare($conexion, "INSERT INTO usuario(usuario,clave,perfil) VALUES (?,?,?);");
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        $consulta->bind_param("sss", $usuario, $hash, $perfil);
        $res = $consulta->execute();

        return $res;
    }

    function insertarCliente($nombre, $email, $birthdate, $phone, $address, $tarjeta, $caducidad, $pin)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'alquiler_de_coches');

        // Preparar la primera consulta
        $stmt1 = mysqli_prepare($conexion, "SELECT max(id_usuario) FROM usuario");
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);
        mysqli_stmt_bind_result($stmt1, $maxIdUsuario);

        // Obtener el valor de id_usuario máximo
        mysqli_stmt_fetch($stmt1);

        // Cerrar el statement preparado de la primera consulta
        mysqli_stmt_close($stmt1);

        $consulta = mysqli_prepare($conexion, "INSERT INTO cliente(id_usuario, nombre, email, fecha_de_nacimiento, numero_de_telefono, direccion, tarjeta_credito, caducidad_tarjeta, pin_tarjeta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $hash = password_hash($tarjeta, PASSWORD_DEFAULT);
        $hash2 = password_hash($caducidad, PASSWORD_DEFAULT);
        $hash3 = password_hash($pin, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($consulta, "issssssss", $maxIdUsuario, $nombre, $email, $birthdate, $phone, $address, $hash, $hash2, $hash3);
        $res = mysqli_stmt_execute($consulta);

        return $res;
    }

    function verificar($usuario, $clave)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'alquiler_de_coches');
        $consulta = mysqli_prepare($conexion, "SELECT usuario, clave, perfil FROM usuario WHERE usuario = ?;");
        $sanitized_usuario = mysqli_real_escape_string($conexion, $usuario);
        $consulta->bind_param("s", $sanitized_usuario);
        $consulta->execute();
        $res = $consulta->get_result();

        if ($res->num_rows == 0) {
            return 'NOT_FOUND';
        }

        if ($res->num_rows > 1) {
            return 'NOT_FOUND';
        }

        $myrow = $res->fetch_assoc();
        $x = $myrow['clave'];

        if (password_verify($clave, $x)) {
            return $myrow['perfil'];
        } else {
            return 'NOT_FOUND';
        }
    }
}