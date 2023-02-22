<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

$q = $_REQUEST["q"];

function ciudadesPorLetra($q){
    $conexion = mysqli_connect('localhost','root','1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: ". mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'world');
    $consulta = mysqli_prepare($conexion, "SELECT city.Name from city inner join country on city.CountryCode = country.Code WHERE country.Name LIKE '$q';"); 
    $consulta->execute();
    $res = $consulta->get_result();   
    $ciudades = array();

    while($myrow = $res->fetch_assoc()){
        array_push($ciudades, $myrow);
    }
    return $ciudades;
}

$ciudades = ciudadesPorLetra($q);

echo json_encode($ciudades);