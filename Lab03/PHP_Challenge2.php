<?php

    //Binua Ralph Gabriel B.    3BSIT-5

    $colors = array("red", "green", "blue", "yellow");

    sort($colors); // sort colors
    array_push($colors, "purple", "orange"); // add more colors
    array_unshift($colors, "Red Apple"); // add object at the beginning
    $colors[2] = "Green Mango"; //update specific index
    print_r($colors);
?>