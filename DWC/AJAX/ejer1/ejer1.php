<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

$q = $_REQUEST["q"];

function ciudadesPorLetra($q){
    $conexion = mysqli_connect('localhost','root','12345');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: ". mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'world');
    $consulta = mysqli_prepare($conexion, "SELECT Name FROM city ORDER BY Name ASC;"); 
    $consulta->execute();
    $res = $consulta->get_result();   
    $ciudades = array();

    while($myrow = $res->fetch_assoc()){
        array_push($ciudades, $myrow);
    }
    return $ciudades;
}

$ciudades = ciudadesPorLetra($q);

$hint = "";
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($ciudades as $name) {
        if (stristr($q, substr($name['Name'], 0, $len))) {
            if ($hint === "") {
                $hint = $name['Name'];
            } else {
            $hint .= ", ".$name['Name'];
            }
        }
    }
}
echo $hint === "" ? "no suggestion" : $hint;
