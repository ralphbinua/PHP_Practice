<?php

//Binua Ralph Gabriel B.    3BSIT-5

for ($i = 1; $i !== 101; $i++){

    if($i % 3 === 0 && $i % 5 === 0){
        echo $i, " is divisible to 3 and 5 \n";
    } elseif($i % 3 === 0){
        echo $i, " is divisible to 3 \n";
    } elseif($i % 5 === 0){
        echo $i, " is divisible to 5 \n";
    } else {
        echo $i, "\n";
    }
 }
 ?>