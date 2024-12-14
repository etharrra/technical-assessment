<?php

function findTopFiveFrequentWords($text)
{
    $text = strtolower(preg_replace('/[\p{P}]/u', '', $text));
    $text_arr = preg_split('/\s+/', $text);
    $text_arr_count = array_count_values($text_arr);

    uksort($text_arr_count, function ($a, $b) use ($text_arr_count) {
        if ($text_arr_count[$a] == $text_arr_count[$b]) {
            return strcmp($a, $b);
        }
        return $text_arr_count[$b] - $text_arr_count[$a];
    });

    return array_slice($text_arr_count, 0, 5);
}

// exmaple
$text = "The quick brown fox jumps over the lazy dog. The dog was not amused. The fox, quick and clever, decided to run away. The lazy dog stayed behind, sleeping under the bright sun. Quick decisions can make a big difference, thought the fox.";
// $text = "don't don't don't love me me you";
$result = findTopFiveFrequentWords($text);
print_r($result);
