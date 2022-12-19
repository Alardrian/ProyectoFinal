<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="categorias.css">
    <title>Categorias</title>
</head>
<body>

    <h1>Cartelera</h1>
    <!-- <a href='peliculas.php?id_categoria=$categoria['><li><img src='img/lloda.jpeg' alt=''>Star wars</li></a> --> 
    <?php

    $conexion = mysqli_connect('localhost','root','12345');
    if (mysqli_connect_errno()){
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'peliculas');
    $consulta = "SELECT ID, nombre, imagen FROM T_Categorias;";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado){
        $mensaje = 'Consulta inválida: ' . mysqli_error($conexion) . "\n";
        $mensaje .= 'Consulta realizada: ' . $consulta;
        die($mensaje);
    }
    else{
        if(($resultado->num_rows) > 0){

            while ( $registro = mysqli_fetch_assoc($resultado)){

                $id = $registro['ID'];
                $nombre = $registro['nombre'];
                $imagen = $registro['imagen'];

                $categoria = [$id, $nombre, $imagen];

                pintarCategorias($categoria);
            }
        }
    }

    function pintarCategorias($categoria){

        echo "<div id='contenedorCategorias'>
        <ul>
            <a href='peliculas.php?id_categoria=$categoria[0]&orden=ID'><li>$categoria[1]</li><img src='$categoria[2]' alt=''></a>
        </ul>  
        </div>";
        
    }
?>
</body>
</html>