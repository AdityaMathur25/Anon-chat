<?php
function generateRandomWord($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $randomWord = '';

    for ($i = 0; $i < $length; $i++) {
        $randomWord .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomWord;
}

// Example usage
$outputString = generateRandomWord(9);
echo "Output String: $outputString";
?>