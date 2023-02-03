<style>
    table,td,tr{
        border-collapse: collapse;
        border: 1px solid black;
        padding: 10px;
        margin-left: 25%;
        margin-top: 10%;
    }
</style>
<?php

class Frecuencia{

    public $string;
    public $abecedario = ['A','B','C','D','E','F','G','H','I','J','K','L',
    'M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

    public $contadorAbecedario = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

    function __construct($string){
       $this->string = strtoupper($string); 
    }

    function contarLetras(){
        $string = $this->string;

        for ($i=0; $i < strlen($string) ; $i++) { 
            
            for ($j=0; $j < count($this->abecedario); $j++) { 
                if ($string[$i] == $this->abecedario[$j]){
                    $this->contadorAbecedario[$j]++;
                }
            }
        }
        echo "<table>";
        echo "<tr>";
        for ($i=0; $i <count($this->abecedario); $i++) { 
            echo "<td>" . $this->abecedario[$i] . "</td>";  
        }
        echo "</tr>";
        echo "<tr>";
        for ($i=0; $i <count($this->contadorAbecedario); $i++) { 
            echo "<td>" . $this->contadorAbecedario[$i] . "</td>";  
        }
        echo "</tr>";
        echo "</table>";
    }
}