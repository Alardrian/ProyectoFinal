<?php
    class cuadrado{
        public $suma1Fila;
        public $filasDistintas = [];
        public $columnasDistintas = [];
        public $diagonal1 = '';
        public $diagonal2 = '';
        public $esMagico;

        function analizarCuadradoMagico($array){
            $this->suma1Fila = $this->sumaPrimeraFila($array);
            $this->filasDistintas = $this->compararFilas($array);
            $this->columnasDistintas = $this->compararColumnas($array);
            $this->diagonal1 = $this->compararDiagonal1($array);
            $this->diagonal2 = $this->compararDiagonal2($array);
            $this->esMagico = $this->compararSumas();
        }

        function compararSumas(){
            if ($this->filasDistintas != [] ||
            $this->columnasDistintas != [] ||
            $this->diagonal1 != '' ||
            $this->diagonal2 != ''){
                return false;
            }
            else {
                return true;
            }
        }

        function sumaPrimeraFila($array){
           $resultado = array_sum($array[0]);
           return $resultado;
        }
        function sumarFilas($array){
            $resultado = [];
            for ($i=0; $i < count($array); $i++) { 
                $resultado[$i] = array_sum($array[$i]);
            }
            return $resultado;
        }

        function compararFilas($array){
            $resultado = [];
            for ($i=0; $i < count($array); $i++) { 
                if (array_sum($array[$i]) != $this->suma1Fila){
                    $resultado[$i] = $i;
                }
            }
            return $resultado;
        }

        function sumarColumnas($array){
            $resultado = [];
            for ($i=0; $i < count($array); $i++) { 
                for ($j=0; $j < count($array[$i]); $j++) { 
                    $resultado[$i] += $array[$j][$i];
                }
            }
            return $resultado;
        }

        function compararColumnas($array){
            $columnasDistintas = [];
            $resultado = [];

            for ($i=0; $i < count($array); $i++) { 
                for ($j=0; $j < count($array[$i]); $j++) {
                    $resultado[$i] += $array[$j][$i];
                }
                if ($resultado[$i] != $this->suma1Fila){
                    $columnasDistintas[$i] = $i;
                }
            }
            return $columnasDistintas;
        }

        function sumarDiagonal1($array){
            $resultado = 0;
            $indiceColumna = count($array)-1;
            for ($i=0; $i < count($array) ; $i++) { 
                $resultado += $array[$indiceColumna-$i][$i];
            }
            return $resultado;
        }

        function compararDiagonal1($array){
            $resultado = 0;
            $indiceColumna = count($array)-1;
            for ($i=0; $i < count($array) ; $i++) { 
                $resultado += $array[$indiceColumna-$i][$i];
            }
            if ($resultado != $this->suma1Fila){
                $resultado = "Primera diagonal";
                return $resultado;
            }
        }

        function sumarDiagonal2($array){
            $resultado = 0;
            for ($i=0; $i < count($array) ; $i++) { 
                $resultado += $array[$i][$i];
            }
            return $resultado;
        }

        function compararDiagonal2($array){
            $resultado = 0;
            for ($i=0; $i < count($array) ; $i++) { 
                $resultado += $array[$i][$i];
            }
            if ($resultado != $this->suma1Fila){
                $resultado = "Segunda diagonal";
                return $resultado;
            }
        }

        function pintarCuadradoMagico($array){
            
            echo '<table>';
                for ($i=0; $i < count($array) ; $i++) { 
                    echo '<tr>';
                    for ($j=0; $j < count($array) ; $j++) { 
                        echo '<td>'.$array[$i][$j];
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            echo'</table>';

            if ($this->esMagico){
                echo '<p style=color:green>ES UN CUADRADO MAGICO</p>';
            }
            else{
                echo '<p style=color:red> NO ES UN CUADRADO MAGICO</p>';
            }
        }
    }
