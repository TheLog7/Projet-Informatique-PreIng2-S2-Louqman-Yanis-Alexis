<?php
    session_start();
    $json = json_decode(file_get_contents('./Comptes/'.$_SESSION['mail'].'.json'), true);
    $json[$_GET['receive']][$_GET['id']]['state'] = 2;
    file_put_contents('./Comptes/'.$_SESSION['mail'].'.json', json_encode($json));
?>
