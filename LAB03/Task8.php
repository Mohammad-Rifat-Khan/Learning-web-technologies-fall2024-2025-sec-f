<?php

    $array = [
        [1, 2, 3, 'A'],
        [1, 2, 'B', 'C'],
        [1, 'D', 'E', 'F']
    ];
    echo "The 2D array is:\n";
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]); $j++) {
            echo $array[$i][$j] . " ";
        }
        echo "\n";
    }

    echo "Shape 1:\n";
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]) - ($i + 1); $j++) {
            echo $array[$i][$j] . " ";
        }
        echo "\n";
    }

    echo "\nShape 2:\n";
    for ($i = 0; $i < count($array); $i++) {
        for ($j = count($array[$i]) - ($i + 1); $j < count($array[$i]); $j++) {
            echo $array[$i][$j] . " ";
        }
        echo "\n";
    }
?>