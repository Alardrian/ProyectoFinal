<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

$q = $_REQUEST["q"];
$p = $_REQUEST["p"];
function ciudadesPorLetra($q,$p){
    $conexion = mysqli_connect('localhost','root','1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: ". mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'world');
    $consulta = mysqli_prepare($conexion, "SELECT city.District, city.Population from city inner join country
    ON city.CountryCode = country.Code WHERE city.Name LIKE '$q' AND country.Name LIKE '$p';"); 
    $consulta->execute();
    $res = $consulta->get_result();   
    $ciudades = array();

    while($myrow = $res->fetch_assoc()){
        array_push($ciudades, $myrow);
    }
    return $ciudades;
}

$ciudades = ciudadesPorLetra($q,$p);

echo json_encode($ciudades);
