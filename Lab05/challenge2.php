<?php 

    function toUpperCase(array $names) {
        foreach ($names as $name) {
            echo strtoupper($name) . "\n";
        }
    }

    $names = ['Alice', 'Bob', 'Charlie', 'David'];
    toUpperCase($names);
?>