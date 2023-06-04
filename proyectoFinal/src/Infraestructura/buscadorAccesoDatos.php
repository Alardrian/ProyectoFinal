<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

$q = $_REQUEST["q"];

function marcasPorLetra($q){
    $conexion = mysqli_connect('localhost','root','1234');
    if (mysqli_connect_errno()) {
        echo "Error al conectar a MySQL: ". mysqli_connect_error();
    }
    mysqli_select_db($conexion, 'alquiler_de_coches');
    $consulta = mysqli_prepare($conexion, "SELECT marca FROM vehiculo GROUP BY marca;"); 
    $consulta->execute();
    $res = $consulta->get_result();   
    $marcas = array();

    while($myrow = $res->fetch_assoc()){
        array_push($marcas, $myrow);
    }
    return $marcas;
}

$marcas = marcasPorLetra($q);

$hint = "";
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($marcas as $name) {
        if (stristr($q, substr($name['marca'], 0, $len))) {
            if ($hint === "") {
                $hint = $name['marca'];
            } else {
            $hint .= ", ".$name['marca'];
            }
        }
    }
}
echo $hint === "" ? "no suggestion" : $hint;
