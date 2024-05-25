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
        <link rel="stylesheet" href="profil.css">
        <title>bienvenue</title>
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
                        <h1>Bonjour, <?= $_SESSION['nom']?></h1>
                        <p><b>Sexe :</b> <?= $_SESSION['genre']?></p>
                        <p><b><?= $_SESSION['age']?>ans</b></p>
                        <p><b><?= $_SESSION['work']?></b></p>
                        <p><b><?= $_SESSION['address']?></b></p>
                        <p><b><?= $_SESSION['height']?>cm</b></p>
                        <p><b><?= $_SESSION['weight']?>kg</b></p>
                        <p><b><?= $_SESSION['eyes']?></b></p>
                        <p><b><?= $_SESSION['situation']?></b></p>
                        <p><b><?= $_SESSION['hairs']?></b></p>
                        <p><b><?= $_SESSION['wish']?></b></p>
                    </div>
                </div>
                <div class="right">
                    <div>
                    <br>
                        <!-- The iframe for the YouTube video -->
                        <iframe id="youtube-player" width="560" height="315" 
                                src="" 
                                frameborder="0" allowfullscreen></allowfullscreen></iframe>
                        <br></br>
                        <!-- Input field to enter the new YouTube video URL -->
                        <!--<input type="text" id="video-url-input" placeholder="Enter YouTube Video URL">
                        <button id="change-video-button">Change Video</button>-->
                        
                        <form action="" method="POST">
                            <input type="text" id="video-url-input" name="video-url-input" placeholder="Changer votre vidéo">
                            <input type="submit" id="change-video-button" value="Changer">
                        </form>

                        <!-- Script to handle dynamic URL change -->
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
                            <form class="bouton-style" action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                                <input type="submit" value="Recherche" name="recherche">
                            </form>
                        </div>
                        <div>
                            <form class="bouton-style"action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                                <input type="submit" value="Deconnexion" name="logout">
                            </form>
                        </div>
                </div>  
            </div>

            <div class="right-column">
                <div class='header'>
                    <div class='page-chat'>
                        <h1 id="moving-text">
                        &nbsp;&nbsp;&nbsp;Page de chat
                        </h1>
                    </div>
                    </div>
                    <div class='framechat'>
                    <!-- Vérifier si l'utilisateur est connecté ou non -->
                    <?php if(isset($_GET['receive'])) { ?>
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
                        <input type='text' class='input-user' id="start-mail" placeholder="Entrez le mail du destinataire" name='receive' />
                        <input type='submit' id="start-chat" class='btn btn-user' value='Démarrer le chat' />
                    </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="script_profil.js"></script>
    </body>
</html>