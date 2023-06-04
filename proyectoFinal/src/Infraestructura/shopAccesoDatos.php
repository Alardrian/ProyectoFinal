<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class ShopAccesoDatos
{
    function __construct()
    {
    }

    function obtenerCoches($tipo_vehiculo)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($conexion, 'alquiler_de_coches');
        $consulta = mysqli_prepare($conexion, "SELECT id_vehiculo, id_tipo_de_vehiculo, marca, modelo, anio, capacidad, precio_dia FROM vehiculo WHERE id_tipo_de_vehiculo = (?) AND id_vehiculo NOT IN(SELECT id_vehiculo FROM reserva);");
        $consulta->bind_param("i", $tipo_vehiculo);
        $consulta->execute();
        $result = $consulta->get_result();
        $coches = array();

        while ($myrow = $result->fetch_assoc()) {
            array_push($coches, $myrow);
        }
        return $coches;
    }
    function borrarCoche($id_vehiculo)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($conexion, 'alquiler_de_coches');
        $consulta = mysqli_prepare($conexion, "DELETE FROM vehiculo WHERE id_vehiculo = (?);");
        $consulta->bind_param("i", $id_vehiculo);
        $res = $consulta->execute();

        return $res;
    }

    function insertarReserva($usuario, $id_vehiculo, $fecha_inicio, $fecha_fin, $costo_diario)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'alquiler_de_coches');

        // Preparar la primera consulta
        $stmt1 = mysqli_prepare($conexion, "SELECT id_usuario FROM usuario WHERE usuario = ?");
        mysqli_stmt_bind_param($stmt1, "s", $usuario);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);
        mysqli_stmt_bind_result($stmt1, $idUsuario);

        // Obtener el valor de id_usuario
        mysqli_stmt_fetch($stmt1);

        // Cerrar el statement preparado de la primera consulta
        mysqli_stmt_close($stmt1);

        $consulta = mysqli_prepare($conexion, "INSERT INTO reserva (id_cliente, id_vehiculo, fecha_de_inicio, fecha_de_fin, costo_diario) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($consulta, "iissd", $idUsuario, $id_vehiculo, $fecha_inicio, $fecha_fin, $costo_diario);
        $res = mysqli_stmt_execute($consulta);

        return $res;
    }

    function insertarFactura($fecha_de_emision, $subtotal, $impuestos, $total)
    {
        $conexion = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error al conectar a MySQL: " . mysqli_connect_error();
        }
        mysqli_select_db($conexion, 'alquiler_de_coches');

        // Preparar la primera consulta
        $stmt1 = mysqli_prepare($conexion, "SELECT max(id_reserva) FROM reserva");
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);
        mysqli_stmt_bind_result($stmt1, $idReserva);

        // Obtener el valor de id_reserva
        mysqli_stmt_fetch($stmt1);

        // Cerrar el statement preparado de la primera consulta
        mysqli_stmt_close($stmt1);

        $consulta = mysqli_prepare($conexion, "INSERT INTO factura (id_reserva, fecha_de_emision, subtotal, impuestos, total) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($consulta, "isdid", $idReserva, $fecha_de_emision, $subtotal, $impuestos, $total);
        $res = mysqli_stmt_execute($consulta);

        return $res;
    }


}