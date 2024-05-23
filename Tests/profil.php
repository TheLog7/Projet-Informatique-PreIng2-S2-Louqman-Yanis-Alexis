<?php
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['recherche'])){
        header("Location:search.php");
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
</head>
<body class="body-light">
    <h1> Profil</h1>

    <div>
        <h1>Bonjour, <?= $_SESSION['nom']?></h1>
        <h2>Sexe : <?= $_SESSION['genre']?></h2>
    </div>

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
            <input type="text" id="video-url-input" name="video-url-input" placeholder="Enter YouTube Video URL">
            <input type="submit" id="change-video-button" value="changer">
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

    <div>
        <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Deconnexion" name="logout">
        </form>
    </div>
    <div class="info-search">
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Recherche" name="recherche">
        </form>
    </div>
</body>
</html>