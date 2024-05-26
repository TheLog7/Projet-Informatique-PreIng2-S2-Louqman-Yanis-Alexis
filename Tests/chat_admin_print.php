<?php
session_start();
function printconv($sender, $receiver){
    $id = 1;
    $mail_s = $_POST['sender'];
    $mail_r = $_POST['receive'];
    $name_s = $sender['nom'];
    $name_r = $receiver['nom'];
    while (isset($sender[$mail_r][$id]) || isset($receiver[$mail_s][$id])){
        if (isset($sender[$mail_r][$id])){
            if($sender[$mail_r][$id]['state'] == 1){
                echo "<p id='user1'><b>".$name_s.'</b> :  '.$sender[$mail_r][$id]['text']."&nbsp;&nbsp;&nbsp;<a id='remove_send' href='javascript:effacermessage(".$id.")'><b>X</b></a></p>";
            }
            elseif ($sender[$mail_r][$id]['state'] == 2){
                echo "<p id='user1'><b>Message supprimé</b></p><br>";
            }
        }
        else{
            if($receiver[$mail_s][$id]['state'] === 1){
                echo "<p id='user2'><b>".$name_r.'</b>  :  '.$receiver[$mail_s][$id]['text']."&nbsp;&nbsp;&nbsp;<a id='remove_receive' href='javascript:effacermessage(".$id.")'><b>X</b></a></p>";
            }
            elseif ($receiver[$mail_s][$id]['state'] === 2){
                echo "<p id='user2'><b>Message supprimé</b></p><br>";                }
        }
        $id ++;
    }
}
if(isset($_POST['get']) && $_POST['get']) {
    // Code pour envoyer l'historique du chat à l'utilisateur
    $mail_s = $_POST['sender'];
    $mail_r = $_POST['receive'];
    $sender = json_decode(file_get_contents('./Comptes/'.$mail_s.'.json'), true);
    $receiver = json_decode(file_get_contents('./Comptes/'.$mail_r.'.json'), true);
    printconv($sender, $receiver);
}

