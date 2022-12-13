<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
    <title>Peliculas</title>
    
    <?php
    if ($_GET["id_categoria"] == "1") {
        $cssFile = "peliculasTerror.css";
        echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    }
    else if ($_GET["id_categoria"] == "2"){
        $cssFile = "peliculasStarwars.css";
        echo "<link rel='stylesheet' href='" . $cssFile . "'>";
    }
    ?>
</head>
<body>
<h1><a class="atras" href="categorias.php"><span class="material-symbols-outlined">cottage</span></a></h1>

<?php
    $conexion = mysqli_connect('localhost','root','12345');
    if (mysqli_connect_errno()){
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'peliculas');
    $id_categoria = $_GET['id_categoria'];
    $sanitized_categoria_id = mysqli_real_escape_string($conexion, $id_categoria);
    $consulta = "SELECT * FROM T_Peliculas WHERE id_categoria='" . $sanitized_categoria_id."';";
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
        echo "<div class='pelicula'>

        <h2>$pelicula[1]</h2>             <p class='votos'>Votos: 0</p>
        <img src='$pelicula[5]' alt=''>   <h3 class='sinopsisTitulo'>Sinopsis</h3>
        <div class='divSinopsisTexto'>
            <p class='sinopsisTexto'>$pelicula[4]</p>
        </div>
        <p class='duracion'>Duración:$pelicula[3] minutos</p>           <a class='link' href='ficha.php?pelicula=$pelicula[0]'>Ver ficha</a>
        
        </div>";
    }
?>

</body>
</html>
