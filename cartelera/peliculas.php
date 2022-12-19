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
<h1>
    <a class="atras" href="categorias.php"><span class="material-symbols-outlined">cottage</span></a>

    <a class="botones" href="peliculas.php?id_categoria=<?php echo $_GET["id_categoria"] ?>&orden=ID">
    <button type="button" class="boton">Predeterminado</button></a>

    <a class="botones" href="peliculas.php?id_categoria=<?php echo $_GET["id_categoria"] ?>&orden=votos">
    <button type="button" class="boton">Ascendiente votos</button></a>

    <a class="botones" href="peliculas.php?id_categoria=<?php echo $_GET["id_categoria"] ?>&orden=votos DESC">
    <button type="button" class="boton">Descendiente votos</button></a>

    <a class="botones" href="peliculas.php?id_categoria=<?php echo $_GET["id_categoria"] ?>&orden=titulo">
    <button type="button" class="boton">Ascendiente alfabetico</button></a>

    <a class="botones" href="peliculas.php?id_categoria=<?php echo $_GET["id_categoria"] ?>&orden=titulo DESC">
    <button type="button" class="boton">Descendiente alfabetico</button></a>
    
</h1>

<?php
    $conexion = mysqli_connect('localhost','root','1234');
    if (mysqli_connect_errno()){
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'peliculas');
    $id_categoria = $_GET['id_categoria'];
    $orden = $_GET['orden'];
    $sanitized_categoria_id = mysqli_real_escape_string($conexion, $id_categoria);
    $sanitized_orden = mysqli_real_escape_string($conexion, $orden);
    $consulta = "SELECT ID, titulo, año, duracion, sinopsis, imagen, votos, id_categoria FROM T_peliculas WHERE id_categoria=" . $sanitized_categoria_id." ORDER BY ". $sanitized_orden .";";
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
        else {
            echo "<div class='pelicula'>
            <h3 class='noPelis'>No hay peliculas aun</h3>
            </div>";
        }
    }

    function pintarPelicula($pelicula){
        echo "<div class='pelicula'>

        <h2>$pelicula[1]</h2>             <p class='votos'>Votos: $pelicula[6]</p>
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
