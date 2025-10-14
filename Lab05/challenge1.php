<?php 

    $fahrenheitToCelsius = fn($f) => ($f-32)*5/9;

    $fahren =64;
    $celsius = $fahrenheitToCelsius($fahren);
    echo "$fahren Fahrenheit  = $celsius Celsius";
?>