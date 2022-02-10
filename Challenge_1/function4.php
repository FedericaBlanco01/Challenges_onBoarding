<?php

$input= readline("Ingrese constraseña: ");
//without spaces
$password = str_replace(' ','',$input);
 
$validityCharacters= true;
for($i=0; $i<strlen($password) && $validityCharacters; $i++)
{
    $asciiValue= ord($password[$i]);
    if($asciiValue<48 || $asciiValue>57){
        $validityCharacters= false;
    }
}

if(strlen($password)<2){
    $validityCharacters= false;
}

echo var_export($validityCharacters); 
?>