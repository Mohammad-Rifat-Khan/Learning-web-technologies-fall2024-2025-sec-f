<?php
    $price=100;
    $vat=15;

    $vatAmount=($price*$vat)/100;

    $total=$price+$vatAmount;

    echo"Price= ".$price."<br>";
    echo "Vat percentage= ".$vat."<br>";
    echo "Total amount= ".$total."";
?>