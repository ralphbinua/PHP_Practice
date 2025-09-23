    <?php

    //Binua Ralph Gabriel B.    3BSIT-5

    $numbers = array(1, 2, 3, 4, 5);
    $sum = 0;
    $quantity = count($numbers);
    foreach ($numbers as $number) {
        $sum += $number;
    }
    echo "The sum of the {$quantity} numbers is: {$sum}";
    ?>