<?php
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }

    if(isset($_POST['clear'])){
        header("Location:profil.php");
    }

    if(isset($_POST['video-url-input'])){
        $video_url = $_POST['video-url-input'];
        $email = $_SESSION['mail'];

        $json_file = file_get_contents("Comptes/$email.json");
        $json_data = json_decode($json_file, true);
        $json_data['ytb_video'] = $video_url;
        file_put_contents("Comptes/$email.json", json_encode($json_data));

        $json_file = file_get_contents("Comptes/users.json");
        $users_file = file_get_contents("Comptes/users.json");
        $users_data = json_decode($users_file, true);
        foreach ($users_data as $key => $user) {
            if ($user['mail'] === $email) {
                // Update the video URL for the user
                $users_data[$key]['ytb_video'] = $video_url;
                break;
            }
        }
        file_put_contents("Comptes/users.json", json_encode($users_data));

        $_SESSION['ytb_video'] = $video_url;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="chat_admin.css">
        <title>bienvenue</title>
        <link rel="icon" href="icon_titre.ico" type="image/gif">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/1.1.9/js/libs/jquery-1.10.2.min.js"></script>
    </head>
    <body class="body-light">
        <input type="checkbox" id="on">
        <label for="on" class="theme"></label>

        <div class="container">
            <?php if ($_SESSION['sub'] == 1) {?>
                <div class='header'>
                    <div class='page-chat'>
                         <h1 id="moving-text">
                                &nbsp;&nbsp;&nbsp;Page Admin
                        </h1>
                    </div>
                            </div>
                            <div class='framechat'>
                            <!-- Vérifier si l'utilisateur est connecté ou non -->
                            <?php if(isset($_SESSION['active_conv']) || isset($_GET['receive'])){
                                if(isset($_GET['receive'])) {
                            ?>
                            <div id='result'>
                                <script>
                                    function effacermessage(id){
                                        $.ajax({
                                            url:'remove.php',
                                            data:{
                                                receive:"<?php echo $_GET['receive'] ?>",
                                                id:id
                                            },
                                            method:'get',
                                        })
                                        return false;
                                    };
                                </script>
                            </div>
                            <div class='chatbody'>
                            <form method="post" onsubmit="return lancerlechat();">
                                <input type='text' name='chat' id='msgbox' placeholder="Tapez votre message ICI" />
                                <input type='submit' name='send' id='send' class='btn btn-send' value='Envoyer' />
                            </form>
                            <form method="post" action="">
                                <input type='submit' name='clear' class='btn btn-clear' id='clear' value='Changer de destinataire' />
                            </form>
                            <script>
                            // Fonction Javascript pour soumettre le nouveau chat entré par l'utilisateur
                            function lancerlechat(){
                                if($('#chat').val()=='' || $('#msgbox').val()=='') {
                                    return false;
                                }
                                    $.ajax({
                                    url:'chat.php',
                                    data:{
                                        msg:$('#msgbox').val(),
                                        receive:"<?php echo $_GET['receive'] ?>",
                                        send:true
                                    },
                                    method:'post',
                                    success:function(data){
                                        // Récupérer les enregistrements du chat et les ajouter à div avec id=result
                                        $('#result').html(data);
                                        //Effacer la boîte de dialogue après une soumission réussie
                                        $('#msgbox').val('');
                                        // Ramener la barre de défilement au bas dans le cas où le chat est longue
                                        document.getElementById('result').scrollTop=document.getElementById('result').scrollHeight;
                                    }
                                    })
                                return false;
                            };
                            // Fonction permettant de vérifier à tout moment si quelqu'un a soumi un nouveau chat.
                            setInterval(function(){
                            $.ajax({
                                url:'chat.php',
                                data:{
                                    get:true,
                                    receive:"<?php echo $_GET['receive'] ?>"
                                },
                                method:'post',
                                success:function(data){
                                    $('#result').html(data);
                                }
                            })
                            },1000);
                            </script>
                            <?php } else { ?>
                            <div class='controlepanel'>
                            <form method="get" id="myForm">
                                <select name="receive" class='input-user' id="start-mail">
                                <?php foreach ($_SESSION['active_conv'] as $keys => $values){
                                        foreach ($values as $mail => $nom){?>
                                    <option value="<?php echo $mail?>"> <?php echo $nom ?> </option>
                                <?php }} ?>
                                </select>
                                <input type='submit' id="start-chat" class='btn btn-user' value='Démarrer le chat' />
                            </form>
                            </div>
                            <?php } ?>
                        </div>
                        <?php }
                            else{ ?>
                                <p> Vous n'avez aucune conversation commencée, allez dans l'onglet recherche et entamez la discussion avec quelqu'un </p>
                        <?php }
                        }
                        else {?>
                            <form action="subscription.php" method="post" id="myForm">
                                <input type='submit' id="sub_button" class='sub_button' value="S'abonner (pour accéder au chat, gratuit pour les femmes)" />
                            </form>
                        <?php } ?>




                    </div>

                </div>
        <script src="script_chat_admin.js"></script>
    </body>