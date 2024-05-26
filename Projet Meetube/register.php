<?php
    // Vérification si le formulaire a été soumis
    require 'session_setup.php';
    $id = 0;
    $infos = 0;
    $sub = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r_name = $_POST["r_name"];
        $r_mail = $_POST["r_mail"];
        $r_password = $_POST["r_password"];
        if($r_mail != '' && $r_name != '' && $r_password != ''){
            if(!file_exists('Comptes')){
                mkdir('Comptes');
                file_put_contents('./Comptes/users.json', '');
            }
            if(!file_exists('./Comptes/'.$r_mail.'.json')){
                $users = json_decode(file_get_contents('./Comptes/users.json'));
                while (isset($users[$id])){
                    $id ++;
                }
                $users[$id] = array('name' => $r_name, 'mail' => $r_mail);
                if($r_mail == 'admin@admin.com'){
                    $sub = 2;
                }
                $infos = array('mail' => $r_mail, 'password' => $r_password, 'name' => $r_name, 'sub' => $sub);
                file_put_contents('./Comptes/'.$r_mail.'.json', json_encode($infos));
                file_put_contents('./Comptes/users.json', json_encode($users));
                session_setup(1, $infos);
                header("Location:register_part2.php");
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