<?php
session_start();
$_SESSION['sub'] = 1;
$json = json_decode(file_get_contents('./Comptes/'.$_SESSION['mail'].'.json'), true);
$json['sub'] = 1;
file_put_contents('./Comptes/'.$_SESSION['mail'].'.json', json_encode($json));
header('Location:profil.php');
?>