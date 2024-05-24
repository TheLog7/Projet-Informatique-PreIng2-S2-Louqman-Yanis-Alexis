<?php
session_start();
echo $_SESSION['mail'];
$json = json_decode(file_get_contents('test.json'), true);
$json[1] = array('state'=>1, 'text'=>'vide tkt');
$json[3] = 'modifie';
$json[3] = array('state'=>1, 'text'=>'vide tkt');
if(isset($json[2])){
    echo 'probleme';
}
else{
    echo 'carré';
}
file_put_contents('test.json',json_encode($json));