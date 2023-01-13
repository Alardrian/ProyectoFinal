<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="voto.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
    <title>Votos</title>
</head>
<body>
    <h1 class='texto'>Gracias por votar</h1>
    <h2 class="imagen"><span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
    <span class='material-symbols-outlined'>recommend</span>
</h2>
    <a href="categorias.php"><h2 class='volver'> Volver a la pagina principal</h2></a>


    <?php

    
    $conexion = mysqli_connect('localhost','root','12345');
    if (mysqli_connect_errno()){
        echo "Error al conectar a MySQL: " . mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'peliculas');
    $id_pelicula = $_POST['idpelicula'];
    $sanitized_pelicula = mysqli_real_escape_string($conexion, $id_pelicula);
    $consulta = "UPDATE peliculas.T_Peliculas SET votos = votos+1 WHERE ID = ". $id_pelicula . ";";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado){
        $mensaje = 'Consulta inválida: ' . mysqli_error($conexion) . "\n";
        $mensaje .= 'Consulta realizada: ' . $consulta;
        die($mensaje);
    }
    
    ?>
</body>
</html>