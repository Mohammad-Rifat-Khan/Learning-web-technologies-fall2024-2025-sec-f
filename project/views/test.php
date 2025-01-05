<?php
$messages = [
    "Hello, world!",
    "Welcome to our website!",
    "Have a great day!",
    "Enjoy your stay!",
    "Thank you for visiting!"
];

$randomIndex = array_rand($messages);
echo $messages[$randomIndex];
?>