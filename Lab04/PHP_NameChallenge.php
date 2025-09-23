<?php

    //Binua Ralph Gabriel B.    3BSIT-5

    $names = ['ALEC', 'BETH', 'CAROLINE', 'DAve', 'ElAnor', 'ANNa', 'Freddie', 'AdaM'];
    $firstLetters = [];

    foreach ($names as $name){
        if(substr($name, 0, 1) !== "A"){
            $firstLetters[] = $name;
        }
    }

    $lowerCase = array_map('strtolower', $firstLetters);
    $reverseString = array_map('strrev', $lowerCase);
    echo implode("\n", $reverseString);
?>