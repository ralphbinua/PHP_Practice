//Binua Ralph Gabriel B.

    <?php
    $numbers = array(1, 2, 3, 4, 5);
    $sum = 0;
    $quantity = count($numbers);
    foreach ($numbers as $number) {
        $sum += $number;
    }
    echo "The sum of the {$quantity} numbers is: {$sum}";
?>