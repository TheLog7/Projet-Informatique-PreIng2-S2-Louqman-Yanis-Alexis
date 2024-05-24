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
                    echo "<b>".$name_s.':</b> '.$sender[$mail_r][$id]['text']."<br>";
                }
                elseif ($sender[$mail_r][$id]['state'] == 2){
                    echo 'Message supprimé<br>';
                }
            }
            else{
                if($receiver[$mail_s][$id]['state'] === 1){
                    echo "<b>".$name_r.':</b> '.$receiver[$mail_s][$id]['text']."<br>";
                }
                elseif ($receiver[$mail_s][$id]['state'] === 2){
                    echo 'Message supprimé<br>';
                }
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
        /*if ( !isset($sender[$mail_r]) || !isset($receiver[$mail_s])){
             $sender[$mail_r] = array(array('text' => $_POST['msg'], 'state' => 1));
             $receiver[$mail_s] = array(array('text' => ' ', 'state' => 3));
             file_put_contents('./Comptes/'.$mail_s.'.json', json_encode($sender));
             file_put_contents('./Comptes/'.$mail_r.'.json', json_encode($receiver));
         }
         else{
             while ( isset($sender[$mail_r][$id]) || isset($receiver[$mail_s][$id]) ){
                 $id ++;
                      }
             $sender[$mail_r][$id] = array('text' => $_POST['msg'], 'state' => 1);
             printconv($sender, $receiver);
             file_put_contents('./Comptes/'.$mail_s.'.json', json_encode($sender));
             file_put_contents('./Comptes/'.$mail_r.'.json', json_encode($receiver));
         }*/
        /*if (!isset($sender[$mail_r])){
            $sender[$mail_r] = array(array('text' => $_POST['msg'], 'state' => 1));
            file_put_contents('./Comptes/'.$mail_s.'.json', json_encode($sender));
        }*/
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
