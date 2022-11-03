<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrado magico</title>
    <style>
    body{
        margin-left: 40%;
        margin-top: 5%;
    }
    table, td, tr{
        border: 1px solid rgb(0, 0, 0);
        border-collapse: collapse;
        text-align: center;
    }
    table{
        width: 300px;
        height: 300px;
    }
    .contenedor{
        height: 100%;
        width: 100%;
        margin: auto;
        margin-top: 25vh;
    }
    </style>
</head>
<body>
    <div id="contenedor">

    </div>
    
    <?php
        
        require 'cuadrado_magico.php';
        $cuadrado = new cuadrado();

        $arrays = [[1,1,1],
                   [2,2,2],
                   [3,3,3]];

        try {
            echo $cuadrado->analizarCuadradoMagico($arrays);
            echo $cuadrado->pintarCuadradoMagico($arrays);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        //echo $cuadrado->sumaPrimeraFila($arrays);
        //echo '<br>';
        
        echo '<br>';
        //print_r($cuadrado->sumarFilas($arrays));
        echo '<br>';
        //print_r($cuadrado->sumarColumnas($arrays));
        echo '<br>';
        //echo $cuadrado->sumarDiagonal1($arrays);
        echo '<br>';
        //echo $cuadrado->sumarDiagonal2($arrays);
        echo '<br>';
        //echo $cuadrado->suma1Fila;
        echo '<br>';
        //print_r($cuadrado->compararFilas($arrays));
        echo '<br>';
        //print_r($cuadrado->compararColumnas($arrays));
        echo '<br>';
        //echo $cuadrado->diagonal1;
        echo '<br>';
        //echo $cuadrado->diagonal2;

    // $objeto = $analizarCuadradoMagico($array)
    // pintarCuadradoMagico($array,$objeto)

    ?>
</body>
</html>