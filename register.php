<?php
    $json = 0;
    $file_exist = false;
    $account_exist = false;
    $id = 1;
    $r_name = $_POST["r_name"];
    $newline = 0;
    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r_mail = $_POST["r_mail"];
        $r_password = $_POST["r_mdp"];
        if(!file_exists('Comptes')){
            mkdir('Comptes');
        }
        $account_exist = file_exists('./Comptes/'.$r_mail.'.json');
        if(!$account_exist){
            file_put_contents('./Comptes/'.$r_mail.'.json', json_encode(array('mail' => $r_mail, 'mdp' => $r_password, 'nom' => $r_name)));
        }
        else {
            header("Location: index.php?error=email_exist");
        }
    }
?>
