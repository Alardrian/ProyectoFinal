<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha</title>
    <?php
    if ($_GET["pelicula"] > 0 && $_GET["pelicula"] <= 5 ) {
        $cssFile = "fichaTerror.css";
        echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    }
    else if ($_GET["pelicula"] > 5 && $_GET["pelicula"] <= 10 ) {
        $cssFile = "fichaStar.css";
        echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    }
    ?>
</head>
<body> 
    <?php
    $conexion = mysqli_connect('localhost','root','12345');
    if (mysqli_connect_errno()){
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'peliculas');
    $id_pelicula = $_GET['pelicula'];
    $sanitized_pelicula = mysqli_real_escape_string($conexion, $id_pelicula);
    $consulta = "SELECT * FROM T_Peliculas WHERE ID='" . $sanitized_pelicula."';";
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
                $titulo = $registro['titulo'];
                $anyo = $registro['año'];
                $duracion = $registro['duracion'];
                $sinopsis = $registro['sinopsis'];
                $imagen = $registro['imagen'];
                $votos = $registro['votos'];
                $idCategoria = $registro['id_categoria'];

                $pelicula = [$id, $titulo, $anyo, $duracion, $sinopsis, $imagen, $votos, $idCategoria];

                pintarPelicula($pelicula);
                
            }
        }
    }
    function pintarPelicula($pelicula){
        echo "<div class='barraArriba'>
        <h1 class='titulo'>$pelicula[1]</h1>
    </div>
    <div class='imagen'>
        <img class='imagen' src='$pelicula[5]' alt=''>
    </div>

    <div class='informacion'>
        <div class='anyoInfo'> Año: $pelicula[2]</div>

        <div class='repartoInfo'> Reparto: </div>

        <div class='directoresInfo'> Directores: </div>

        <div class='sinopsisInfo'> Sinopsis: $pelicula[4]</div>

        <div class='duracionInfo'> Duracion: $pelicula[3] min</div>
    </div> ";
    }

    ?>

    

</body>
</html>