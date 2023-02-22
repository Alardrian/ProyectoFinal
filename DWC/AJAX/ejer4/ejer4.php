<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

function ciudades(){
    $conexion = mysqli_connect('localhost','root','1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: ". mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'world');
    $consulta = mysqli_prepare($conexion, "SELECT Name FROM country ORDER BY Name ASC;"); 
    $consulta->execute();
    $res = $consulta->get_result();   
    $ciudades = array();

    while($myrow = $res->fetch_assoc()){
        array_push($ciudades, $myrow);
    }
    return $ciudades;
}

$ciudades = ciudades();

echo json_encode($ciudades);