<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 0);

require("cuadrado_magico.php");

function test_esMagico(){
    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->compararSumas();

    return ($x == false);
}

function test_sumaPrimeraFila(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->sumaPrimeraFila($arrays);
    
    return ($x == 3);
}

function test_sumarFilas(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->sumarFilas($arrays);

    return ($x == [3,6,9]);
}

function test_compararFilas(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $cuadrado1->suma1Fila = $cuadrado1->sumaPrimeraFila($arrays);
    $x = $cuadrado1->compararFilas($arrays);

    return ($x == [2,3]);
}

function test_sumarColumnas(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->sumarColumnas($arrays);

    return ($x == [6,6,6]);
}

function test_compararColumnas(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->compararColumnas($arrays);

    return ($x == [1,2,3]);
}

function test_sumarDiagonal1(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->sumarDiagonal1($arrays);

    return ($x == 6);
}

function test_compararDiagonal1(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->compararDiagonal1($arrays);

    return ($x == "Primera diagonal");
}

function test_sumarDiagonal2(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->sumarDiagonal2($arrays);

    return ($x == 6);
}

function test_compararDiagonal2(){
    $arrays = [[1,1,1],
           [2,2,2],
           [3,3,3]];

    $cuadrado1 = new cuadrado();
    $x = $cuadrado1->compararDiagonal2($arrays);

    return ($x == "Segunda diagonal");
}

function test($testEjecutar){
    try{
        echo "<br>";
        $resultadoTest = $testEjecutar();
        $mensaje = 'El test: '.$testEjecutar.' ';
        $mensajeResultado = $resultadoTest ? 'OK' : 'KO';
        echo $mensaje.$mensajeResultado;
    }
    catch(Exception $e)
    {
        echo "<br>"."Se ha producido una excepción al ejecutar:".$testEjecutar."<br>";
    } 
}

echo "<br>";
echo "<br><p style=color:blue>Test es magico</p><br>";
test("test_esMagico");
echo "<br>";

echo "<br><p style=color:blue>Test sumar primera fila</p><br>";
test("test_sumaPrimeraFila");
echo "<br>";

echo "<br><p style=color:blue>Test sumar filas</p><br>";
test("test_sumarFilas");
echo "<br>";

echo "<br><p style=color:blue>Test comparar filas</p><br>";
test("test_compararFilas");
echo "<br>";

echo "<br><p style=color:blue>Test sumar columnas</p><br>";
test("test_sumarColumnas");
echo "<br>";

echo "<br><p style=color:blue>Test comparar columnas</p><br>";
test("test_compararColumnas");
echo "<br>";

echo "<br><p style=color:blue>Test sumar primera diagonal</p><br>";
test("test_sumarDiagonal1");
echo "<br>";

echo "<br><p style=color:blue>Test comparar primera diagonal</p><br>";
test("test_compararDiagonal1");
echo "<br>";

echo "<br><p style=color:blue>Test sumar segunda diagonal</p><br>";
test("test_sumarDiagonal2");
echo "<br>";

echo "<br><p style=color:blue>Test comparar segunda diagonal</p><br>";
test("test_compararDiagonal2");
echo "<br>";

