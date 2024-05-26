<?php
    session_start();

    if (!isset($_SESSION['name'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['Recherche'])){
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
        <link rel="stylesheet" href="profil.css">
        <title>Votre Profil</title>
        <link rel="icon" href="icon_titre.ico" type="image/gif">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/1.1.9/js/libs/jquery-1.10.2.min.js"></script>
    </head>
    <body class="body-light">
        <input type="checkbox" id="on">
        <label for="on" class="theme"></label>
        <div class="container">
            <div class="left-column">
                <div class="left">
                    <div class="present">
                        <h1>Bonjour  <?= $_SESSION['name']?></h1>
                        <p><b>Sexe : <?= $_SESSION['genre']?></b></p>
                        <p><b><?= $_SESSION['age']?>&nbsp;ans</b></p>
                        <p><b><?= $_SESSION['mail']?></b></p>
                        <?php if ($_SESSION['work'] != ""){?>
                        <p><b><?= $_SESSION['work']?></b></p>
                        <?php } ?>
                        <?php if ($_SESSION['address'] != ""){?>
                        <p><b>habite à&nbsp;<?= $_SESSION['address']?></b></p>
                        <?php } ?>
                        <?php if ($_SESSION['height'] != ""){?>
                        <p><b><?= $_SESSION['height']?>cm</b></p>
                        <?php } ?>
                        <?php if ($_SESSION['weight'] != ""){?>
                        <p><b><?= $_SESSION['weight']?>kg</b></p>
                        <?php } ?>
                        <?php if ($_SESSION['eyes'] != ""){?>
                        <p><b>A les yeux&nbsp;<?= $_SESSION['eyes']?></b></p>
                        <?php } ?>
                        <p><b><?= $_SESSION['situation']?></b></p>
                        <?php if ($_SESSION['hairs'] != ""){?>
                        <p><b><?= $_SESSION['hairs']?></b></p>
                        <?php } ?>
                        <p><b>Cherche :&nbsp;<?= $_SESSION['wish']?></b></p>
                    </div>
                </div>
                <div class="right">
                    <div>
                        <h1 id="prefere">Vidéo préférée :</Video></h1>
                        <br><br><br>
                            <iframe id="youtube-player" width="560" height="315" 
                                    src="" 
                                    frameborder="0" allowfullscreen></allowfullscreen></iframe>
                            <br></br>
                            
                            <form action="" method="POST">
                                <input type="text" id="video-url-input" name="video-url-input" placeholder="Changer votre vidéo">
                                <input type="submit" id="change-video-button" value="Changer">
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Récupérer l'URL de la vidéo depuis la variable PHP
                                    var videoUrl = '<?= $_SESSION['ytb_video'] ?>';
                                    var iframe = document.getElementById('youtube-player');

                                    // Fonction pour extraire l'ID de la vidéo depuis l'URL
                                    function getVideoId(url) {
                                        var regExp = /^.*(youtu.be\/|v\/|embed\/|watch\?v=|watch\?.+&v=)([^#\&\?]*).*/;
                                        var match = url.match(regExp);
                                        return (match && match[2].length == 11) ? match[2] : null;
                                    }

                                    // Mettre à jour l'iframe avec l'ID de la vidéo extraite
                                    var videoId = getVideoId(videoUrl);
                                    if (videoId) {
                                        iframe.src = 'https://www.youtube.com/embed/' + videoId;
                                    }
                                });
                            </script>
                    </div>
                    
                        <div class="info-search">
                            <form class="bouton-style" action="" method="POST">  
                                <input type="submit" value="Recherche" name="Recherche">
                            </form>
                        </div>
                        <div>
                            <form class="bouton-style" action="logout.php" method="POST">  
                                <input type="submit" value="Deconnexion" name="logout">
                            </form>
                        </div>
                        <div>
                            <form class="bouton-style" action="profil_modif.php" method="POST">  
                                <input type="submit" value="Modifier votre profil" name="modif">
                            </form>
                        </div>
                        <?php if ($_SESSION['sub'] == 2){?>
                        <div>
                            <form class="bouton-style" action="chat_admin.php" method="POST">  
                                <input type="submit" value="Messagerie admin" name="chat_admin">
                            </form>
                        </div>
                        <?php } ?>
                    </div>
            </div>

            <div class="right-column">
                <?php if ($_SESSION['sub'] == 1 || $_SESSION['sub'] == 2) {?>
                <div class='header'>
                    <div class='page-chat'>
                        <h1 id="moving-text">
                        &nbsp;&nbsp;&nbsp;Page de chat
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
                                    foreach ($values as $mail => $name){?>
                                <option value="<?php echo $mail?>"> <?php echo $name ?> </option>
                                    <?php }} ?>
                            </select>
                            <input type='submit' id="start-chat" class='btn btn-user' value='Démarrer le chat' />
                        </form>
                    </div>
                            <?php if (isset($_SESSION['visits'])) {?>
                            <div class="liste"> <h1> Liste des gens qui ont vu votre profil :</h1>
                                <?php foreach ($_SESSION['visits'] as $visit){?>
                                    <p> <?php echo $visit ?> </p>
                                <?php       }?>
                            </div>
                        <?php }
                        } ?>
                </div>
                <?php }
                    else{ ?>
                        <p> Vous n'avez aucune conversation commencée, allez dans l'onglet recherche et entamez la discussion avec quelqu'un </p>
                        <?php if (isset($_SESSION['visits'])) {?>
                            <div class="liste"> <h1> Liste des gens qui ont vu votre profil :</h1>
                            <?php foreach ($_SESSION['visits'] as $visit){?>
                                <p> <?php echo $visit ?> </p>
                <?php       }?>
                            </div>
                        <?php }
                    }
                }
                else {?>
                    <form action="subscription.php" method="post" id="myForm">
                        <input type='submit' id="sub_button" class='sub_button' value="S'abonner" />
                    </form>
                <?php } ?>
            </div>

        </div>
        <script src="script_profil.js"></script>
    </body>
</html>
