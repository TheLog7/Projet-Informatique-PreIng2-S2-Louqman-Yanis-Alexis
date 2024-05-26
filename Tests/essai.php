<?php
session_start();
print_r($_SESSION['active_conv']);
echo "<br>";
$test = [
    'email1@example.com' => 'Nom 1',
    'email2@example.com' => 'Nom 2',
    'email3@example.com' => 'Nom 3',
];
print_r($test);