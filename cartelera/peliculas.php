<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link rel="stylesheet" href="peliculasTerror.css">
</head>
<body>

<div class="pelicula">

<h2>Titulo</h2>             <p class="votos">Votos: 0</p>
<img src="img/peniwais.jpg" alt="">   <h3 class="sinopsisTitulo">Sinopsis</h3>
<div class="divSinopsisTexto">
    <p class="sinopsisTexto">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae voluptatum excepturi 
        animi voluptatibus minus. Molestias, tempore et voluptate eveniet minus dicta blanditiis impedit rem totam sapiente 
        corporis iste unde placeat modi odio quae ipsum eos? Delectus quibusdam voluptatibus aspernatur optio?</p>
</div>
<p class="duracion">Duración: minutos</p>           <a href="ficha.php">Ver ficha</a>

</div>

<div class="pelicula">

<h2>Titulo</h2>             <p class="votos">Votos: 0</p>
<img src="img/jason.jpeg" alt="">   <h3 class="sinopsisTitulo">Sinopsis</h3>
<div class="divSinopsisTexto">
    <p class="sinopsisTexto">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repudiandae voluptatum excepturi 
        animi voluptatibus minus. Molestias, tempore et voluptate eveniet minus dicta blanditiis impedit rem totam sapiente 
        corporis iste unde placeat modi odio quae ipsum eos? Delectus quibusdam voluptatibus aspernatur optio?</p>
</div>

<p class="duracion">Duración: minutos</p>           <a href="ficha.php">Ver ficha</a>

</div>

<?php
    $conexion = mysqli_connect('localhost','root','12345');
    mysqli_select_db($conexion, 'peliculas');
    $consulta = "SELECT * FROM T_Peliculas;";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado){
        $mensaje = 'Consulta inválida: ' . mysqli_error($conexion) . "\n";
        $mensaje .= 'Consulta realizada: ' . $consulta;
        die($mensaje);
    }
    else{
        echo "Conexión OK"."<br>";

        while ( $registro = mysqli_fetch_assoc($resultado)){
            echo $registro['titulo']."<br>";
            
        }
    }
?>

</body>
</html>
