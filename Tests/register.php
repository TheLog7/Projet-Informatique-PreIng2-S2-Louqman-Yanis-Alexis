<?php
    // Vérification si le formulaire a été soumis
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r_name = $_POST["r_name"];
        $r_mail = $_POST["r_mail"];
        $r_password = $_POST["r_mdp"];
        if($r_mail != '' && $r_name != '' && $r_password != ''){
            if(!file_exists('Comptes')){
                mkdir('Comptes');
            }
            if(!file_exists('./Comptes/'.$r_mail.'.json')){
                file_put_contents('./Comptes/'.$r_mail.'.json', json_encode(array('mail' => $r_mail, 'mdp' => $r_password, 'nom' => $r_name)));
                $_SESSION['mail'] = $r_mail;
                $_SESSION['nom'] = $r_name;
                $_SESSION['mdp'] = $r_password;
                header("Location:test.php");
            }
            else {
                header("Location: index.php?error=email_exist");
            }
        }
        else{
            header("Location: index.php?error=missing_info");
        }
    }
?>