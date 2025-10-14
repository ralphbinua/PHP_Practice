<?php 

function findLongestWord( $sentence) { 
    $words = explode(" ", $sentence );
    $longestWord = '';
    $maxLength = 0;
    
    foreach($words as $word) {
        $cleanWord = trim($word, ".,!?:;");
        $currentLength = strlen($cleanWord);
        
        if ($currentLength > $maxLength) {
            $maxLength = $currentLength;
            $longestWord = $cleanWord;
        }
    }
    
    return $longestWord; 
}
 
$sentence = 'The quick brown fox jumped over the lazy dog';
$longestWord = findLongestWord($sentence);
echo $longestWord;

?>