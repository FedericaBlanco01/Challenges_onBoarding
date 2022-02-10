<?php

$cadena= readline("Ingrese cadena de DNA en mayúscula: ");
$ret="";
 
// Recorremos cada carácter de la cadena
for($i=0;$i<strlen($cadena);$i++)
{
    switch ($cadena[$i]) {
        case "G":
            $ret = $ret . "C";
            break;
        case "C":
            $ret = $ret ."G";
            break;
        case "T":
            $ret = $ret . "A";
            break;
        case "A":
            $ret = $ret . "U";
            break;
        default:
            echo "Error de ingreso";
    }
}

echo $ret;

//match

?>