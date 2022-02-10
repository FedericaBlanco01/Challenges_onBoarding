<?php


$input= readline("Ingrese número a veríficar: ");
$payload= substr($input, 0, -1); 
$checkDigit= $input[strlen($input)-1];    

$checkSum= 0 ;
$pos= true; //true x2, else x1

for($i=strlen($payload)-1; $i >= 0 ; $i--)
{
    if($pos){

        $cuenta= intval($payload[$i]) * 2;
        if($cuenta > 9){
            $checkSum= $checkSum +  ($cuenta-10) + 1;
        }else{
            $checkSum= $checkSum +  $cuenta;
        }
        $pos= false;

    }else{
        $checkSum= $checkSum + (intval($payload[$i]));
        $pos= true;
    }
    
        
}

//calcular los modulos con la suma
$calculus= ((10 - $checkSum % 10) %10);

echo var_export(intval($checkDigit) == $calculus);
?>
