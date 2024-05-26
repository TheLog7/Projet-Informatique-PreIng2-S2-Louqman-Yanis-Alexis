<?php
    session_start();
    $json_send = json_decode(file_get_contents('./Comptes/'.$_POST['sender'].'.json'), true);
    $json_receive = json_decode(file_get_contents('./Comptes/'.$_POST['receive'].'.json'), true);
    if (isset($json_send[$_POST['receive']][$_POST['id']])){
        $json_send[$_POST['receive']][$_POST['id']]['state'] = 2;
    }
    else{
        $json_receive[$_POST['sender']][$_POST['id']]['state'] = 2;
    }

    file_put_contents('./Comptes/'.$_POST['sender'].'.json', json_encode($json_send));
    file_put_contents('./Comptes/'.$_POST['receive'].'.json', json_encode($json_receive));
?>