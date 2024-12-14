<?php

function sumArrayWithinRange($start, $end)
{
    $arr = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];

    if ($start < 1 || $end < 1) {
        return -1;
    }

    if ($start > $end || $start > max($arr)) {
        return 0;
    }

    $sum = 0;
    foreach ($arr as $item) {
        if ($item >= $start && $item <= $end) {
            $sum += $item;
        }
    }
    return $sum;
}

$start = 110;
$end = 120;
$result = sumArrayWithinRange($start, $end);
echo "Sum between $start and $end is $result \n";
