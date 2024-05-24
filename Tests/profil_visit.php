<?php
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }

    if(isset($_POST['profil'])){
        header("Location:profil.php");
    }

    if(isset($_POST['mail'])){
        $jsonFile = './Comptes/' . $_POST['mail'] . '.json';
        if(file_exists($jsonFile)){
            $jsonData = file_get_contents($jsonFile);
            $user = json_decode($jsonData, true);
            // Now you can access the user information from the JSON file
            $name = $user['nom'];
            $gender = $user['genre'];
            $ytb_video = $user['ytb_video'];
        }
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
    <h1> Vous êtes sur la page de <?= $name ?> : </h1>

    <div>
        <h1>Bonjour, <?= $_SESSION['nom']?></h1>
        <h2>Sexe : <?= $gender ?></h2>
    </div>

    <div>
    <br>
        <!-- The iframe for the YouTube video -->
        <iframe id="youtube-player" width="560" height="315" 
                src="" 
                frameborder="0" allowfullscreen></allowfullscreen></iframe>
        <br></br>

        <!-- Script to handle dynamic URL change -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Récupérer l'URL de la vidéo depuis la variable PHP
                var videoUrl = '<?= $ytb_video ?>';
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
    <br>
    <div class="info-profil">
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Mon Profil" name="profil">
        </form>
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