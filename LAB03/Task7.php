<?php
function printShapes() {
    echo "First Shape:\n";
    for ($i = 1; $i <= 3; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo "*";
        }
        echo "\n";
    }
    echo "\n";

    echo "Second Shape:\n";
    for ($i = 3; $i > 0; $i--) {
        for ($j = 1; $j <= $i; $j++) {
            echo "$j ";
        }
        echo "\n";
    }
    echo "\n";

    echo "Third Shape:\n";
    $ch = 'A';
    for ($i = 1; $i <= 3; $i++) {
        for ($j = 1; $j <= $i; $j++) {
                echo "$ch ";
                $ch++;
            }
            echo "\n";
        }
        echo "\n";
    }
    printShapes();
?>