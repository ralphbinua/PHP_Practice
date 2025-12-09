<?php
/**
 * PHP code to calculate Soul, Personality, and Destiny (Expression) Numbers
 * based on the provided numerology rules, outputting to console.
 */

// Define the name array
$names = array("John Smith", "John Doe", "EJ", "Alex", "Yvonne");

/**
 * Assigns a numerical value (1-9) to a letter based on numerology rules.
 * The mapping from the source document (pages 3-4):
 * 1: A, J, S
 * 2: B, K, T
 * 3: C, L, U
 * 4: D, M, V
 * 5: E, N, W
 * 6: F, O, X
 * 7: G, P, Y
 * 8: H, Q, Z
 * 9: I, R
 */
function get_letter_value(string $letter): int {
    $letter = strtoupper($letter);
    $mapping = [
        'A' => 1, 'J' => 1, 'S' => 1,
        'B' => 2, 'K' => 2, 'T' => 2,
        'C' => 3, 'L' => 3, 'U' => 3,
        'D' => 4, 'M' => 4, 'V' => 4,
        'E' => 5, 'N' => 5, 'W' => 5,
        'F' => 6, 'O' => 6, 'X' => 6,
        'G' => 7, 'P' => 7, 'Y' => 7,
        'H' => 8, 'Q' => 8, 'Z' => 8,
        'I' => 9, 'R' => 9,
    ];
    return $mapping[$letter] ?? 0;
}

/**
 * Reduces a sum to a single digit or a Master Number (11, 22, 33).
 * @param int $number The sum to reduce.
 * @return array An array containing the final reduced number (int) and the reduction steps (string).
 */
function reduce_number(int $number): array {
    $steps_array = [];
    $current_sum = $number;
    $master_numbers = [11, 22, 33]; // Master numbers

    // Capture the initial sum
    $steps_array[] = (string)$current_sum;

    while ($current_sum > 9) {
        // If the sum is a Master Number, stop reduction
        if (in_array($current_sum, $master_numbers)) {
             break;
        }

        $digits = str_split((string)$current_sum);
        $new_sum = array_sum($digits);

        // Record the reduction step
        $steps_array[] = implode('+', $digits);
        $steps_array[] = (string)$new_sum;
        
        $current_sum = $new_sum;

        // If the new sum is a Master Number, stop reduction
        if (in_array($current_sum, $master_numbers)) {
            break;
        }
    }
    
    // Format the steps for display: (44) = (4+4) = 8
    $formatted_steps = "";
    $step_count = count($steps_array);
    for($i = 0; $i < $step_count; $i++) {
        if ($i % 2 == 0) {
            $formatted_steps .= "($steps_array[$i])";
        } else {
            $formatted_steps .= " = ($steps_array[$i]) = ";
        }
    }

    // Clean up the final format: (44) = (4+4) = 8
    // If it's a single reduction (e.g., 44 -> 8)
    if ($step_count >= 3) {
        $formatted_steps = "(" . $steps_array[0] . ") = (" . $steps_array[1] . ") = " . $steps_array[$step_count - 1];
    } elseif ($step_count == 1) {
         $formatted_steps = "(" . $steps_array[0] . ")";
    }


    return [
        'number' => $current_sum,
        'sum' => $number,
        'steps' => $formatted_steps,
    ];
}

/**
 * Checks if a letter is a vowel (A, E, I, O, U, Y).
 * 'Y' is included as a vowel based on the example calculations/names.
 */
function is_vowel(string $letter): bool {
    // Vowels for Soul number are A, E, I, O, U, Y
    return in_array(strtoupper($letter), ['A', 'E', 'I', 'O', 'U', 'Y']);
}

/**
 * Calculates the three main numerology numbers for a name.
 */
function calculate_numerology_numbers(string $full_name): array {
    $clean_name = strtoupper(preg_replace('/[^A-Z]/', '', $full_name)); // Remove spaces and non-letters
    $length = strlen($clean_name);

    $vowel_sum = 0;
    $consonant_sum = 0;
    $total_sum = 0;

    $vowel_values = [];
    $consonant_values = [];
    $total_values = [];

    for ($i = 0; $i < $length; $i++) {
        $letter = $clean_name[$i];
        $value = get_letter_value($letter);
        
        $total_sum += $value;
        $total_values[] = (string)$value;

        if (is_vowel($letter)) {
            $vowel_sum += $value;
            $vowel_values[] = (string)$value;
        } else {
            $consonant_sum += $value;
            $consonant_values[] = (string)$value;
        }
    }

    $destiny_result = reduce_number($total_sum);
    $soul_result = reduce_number($vowel_sum);
    $personality_result = reduce_number($consonant_sum);

    return [
        'soul' => [
            'number' => $soul_result['number'],
            'sum_steps' => implode('+', $vowel_values) . ' = ' . $vowel_sum,
            'reduction_steps' => $soul_result['steps']
        ],
        'personality' => [
            'number' => $personality_result['number'],
            'sum_steps' => implode('+', $consonant_values) . ' = ' . $consonant_sum,
            'reduction_steps' => $personality_result['steps']
        ],
        'destiny' => [
            'number' => $destiny_result['number'],
            'sum_steps' => implode('+', $total_values) . ' = ' . $total_sum,
            'reduction_steps' => $destiny_result['steps']
        ],
    ];
}

/**
 * Returns the personality description for a number.
 */
function get_personality_description(int $number): string {
    $descriptions = [
        1 => 'pioneering, leading, independent, attaining, individualistic',
        2 => 'cooperation, adaptability, considering, partnering, mediating',
        3 => 'expression, verbalization, socialization, arts, joy of living',
        4 => 'values foundation, service, struggle against limits, steady growth',
        5 => 'expansiveness, visionary, adventure, constructive use of freedom',
        6 => 'responsibility, protection, nurturing, balance, sympathy',
        7 => 'analysis, understanding, awareness, studious, meditating',
        8 => 'practical endeavors, status oriented, power-seeking, high-material goals',
        9 => 'humanitarian, giving, selflessness, obligations, creative expression',
        11 => 'higher spiritual plane, intuitive, illumination, idealist, a dreamer',
        22 => 'master builder, large endeavors, powerful force, leadership',
        33 => 'Master Teacher',
    ];
    return $descriptions[$number] ?? 'No description available';
}

/**
 * Returns the destiny description for a number.
 */
function get_destiny_description(int $number): string {
    $descriptions = [
        1 => 'Primal Force',
        2 => 'All Knowing',
        3 => 'Creative Child',
        4 => 'Salt of the Earth',
        5 => 'Dynamic Force',
        6 => 'The Caretaker',
        7 => 'The Seeker',
        8 => 'Balance and Power',
        9 => 'The Caretaker',
        11 => 'The Intuitive',
        22 => 'Master Builder',
        33 => 'Master Teacher',
    ];
    return $descriptions[$number] ?? 'No description available';
}

// Console Output Generation
echo "--- Numerology Name Number Calculator ---\n";

foreach ($names as $name) {
    $results = calculate_numerology_numbers($name);

    // --- Destiny Number (Expression Number) ---
    $destiny_num = $results['destiny']['number'];
    $destiny_desc = get_destiny_description($destiny_num);
    $destiny_sum_steps = $results['destiny']['sum_steps'];
    $destiny_reduction_steps = $results['destiny']['reduction_steps'];

    // --- Soul Number (Vowels) ---
    $soul_num = $results['soul']['number'];
    $soul_sum_steps = $results['soul']['sum_steps'];
    $soul_reduction_steps = $results['soul']['reduction_steps'];
    
    // --- Personality Number (Consonants) ---
    $personality_num = $results['personality']['number'];
    $personality_desc = get_personality_description($personality_num);
    $personality_sum_steps = $results['personality']['sum_steps'];
    $personality_reduction_steps = $results['personality']['reduction_steps'];

    echo "  Hi $name your name number in Numerology is";

    // Destiny Number Output
    echo "• Destiny Number (Expression) is: $destiny_num $destiny_desc\n";
    echo "  Total Sum: ($destiny_sum_steps)\n";
    echo "  Reduction: $destiny_reduction_steps\n";

    // Soul Number Output
    echo "Soul Number is: $soul_num\n";
    echo "  Vowels Sum: ($soul_sum_steps)\n";
    echo "  Reduction: $soul_reduction_steps\n";

    // Personality Number Output
    echo "• Personality Number is: $personality_num $personality_desc\n";
    echo "  Consonants Sum: ($personality_sum_steps)\n";
    echo "  Reduction: $personality_reduction_steps\n";
}

echo "\n----------------------------------------\n";
?>