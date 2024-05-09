<?php
    $json = 0;
    $file_exist = false;
    $account_exist = false;
    $id = 1;
    $r_name = $_POST["r_name"];
    $newline = 0;
    if(file_exists('donnees.json')){
        $json = json_decode(file_get_contents('donnees.json'), true);
        $file_exist = true;
    }
    else{
        file_put_contents('donnees.json','');
        echo 'Fichier créé<br>';
    }
    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r_mail = $_POST["r_mail"];
        $r_password = $_POST["r_mdp"];
        if($file_exist){
            foreach ($json as $key => $value){
                if($json[$key]['mail'] == $r_mail){
                    header("Location: index.php?error=email_exist");
                    $account_exist = true;
                    break;
                }
                $id ++;
            }
            if (!$account_exist){
                $json['Utilisateur' . $id] = array('mail' => $r_mail, 'mdp' => $r_password, 'nom' => $r_name);
                echo '<pre>';
                print_r($json);
                echo '</pre>';
                file_put_contents('donnees.json', json_encode($json));
            }
        }
        else {
            $newline = array('Utilisateur'.$id => array('mail' => $r_mail, 'mdp' => $r_password, 'nom' => $r_name));
            echo '<pre>';
            print_r($newline);
            echo '</pre>';
            file_put_contents('donnees.json',json_encode($newline));
        }
    }
?>