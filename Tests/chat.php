<?php
    session_start();
    function printconv($sender, $receiver){
        $id = 1;
        $mail_s = $_SESSION['mail'];
        $mail_r = $_POST['receive'];
        $name_s = $_SESSION['nom'];
        $name_r = $receiver['nom'];
        while (isset($sender[$mail_r][$id]) || isset($receiver[$mail_s][$id])){
            if (isset($sender[$mail_r][$id])){
                if($sender[$mail_r][$id]['state'] == 1){
                    echo "<p id='user1'><b>".$name_s.'</b> :  '.$sender[$mail_r][$id]['text']."&nbsp;&nbsp;&nbsp;<a id='remove' href='javascript:effacermessage(".$id.")'><b>X</b></a></p>";
                }
                elseif ($sender[$mail_r][$id]['state'] == 2){
                    echo "<p id='user1'><b>Message supprimé</b></p><br>";
                }
            }
            else{
                if($receiver[$mail_s][$id]['state'] === 1){
                    echo "<p id='user2'><b>".$name_r.'</b>  :  '.$receiver[$mail_s][$id]['text']."</p><br>";
                }
                elseif ($receiver[$mail_s][$id]['state'] === 2){
                    echo "<p id='user2'><b>Message supprimé</b></p><br>";                }
            }
            $id ++;
        }
    }
    if(isset($_POST['send']) && $_POST['send']==true){
        // Code pour sauvegarder et envoyer le chat
        $mail_s = $_SESSION['mail'];
        $mail_r = $_POST['receive'];
        $sender = json_decode(file_get_contents('./Comptes/'.$mail_s.'.json'), true);
        $receiver = json_decode(file_get_contents('./Comptes/'.$mail_r.'.json'), true);
        $id = 1;
        if(!isset($sender['active_conv'])){
            $sender['active_conv'] = array(array($receiver['mail']=>$receiver['nom']));
            $_SESSION['active_conv'] = $sender['active_conv'];
            if(!isset($receiver['active_conv'])){
                $receiver['active_conv'] = array(array($sender['mail']=>$sender['nom']));
            }
            elseif (!in_array(array($sender['mail']=>$sender['nom']), $receiver['active_conv'])){
                $new_talk = count($receiver['active_conv']);
                $receiver['active_conv'][$new_talk] = array($sender['mail']=>$sender['nom']);
            }
        }
        elseif (!in_array(array($receiver['mail']=>$receiver['nom']), $sender['active_conv'], true)){
            $new_talk = count($sender['active_conv']);
            $sender['active_conv'][$new_talk] = array($receiver['mail']=>$receiver['nom']);
            $_SESSION['active_conv'] = $sender['active_conv'];
            if(!isset($receiver['active_conv'])){
                $receiver['active_conv'] = array(array($sender['mail']=>$sender['nom']));
            }
            elseif (!in_array(array($sender['mail']=>$sender['nom']), $receiver['active_conv'])){
                $new_talk = count($receiver['active_conv']);
                $receiver['active_conv'][$new_talk] = array($sender['mail']=>$sender['nom']);
            }
        }
        while ( isset($sender[$mail_r][$id]) || isset($receiver[$mail_s][$id]) ){
            $id ++;
        }
        $sender[$mail_r][$id] = array('text' => $_POST['msg'], 'state' => 1);
        printconv($sender, $receiver);
        file_put_contents('./Comptes/'.$mail_s.'.json', json_encode($sender));
        file_put_contents('./Comptes/'.$mail_r.'.json', json_encode($receiver));
    }
    else if(isset($_POST['get']) && $_POST['get']==true) {
        // Code pour envoyer l'historique du chat à l'utilisateur
        $mail_s = $_SESSION['mail'];
        $mail_r = $_POST['receive'];
        $sender = json_decode(file_get_contents('./Comptes/'.$mail_s.'.json'), true);
        $receiver = json_decode(file_get_contents('./Comptes/'.$mail_r.'.json'), true);
        printconv($sender, $receiver);
    }
