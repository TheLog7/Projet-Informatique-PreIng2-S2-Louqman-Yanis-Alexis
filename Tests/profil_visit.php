<?php
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }

    if(isset($_POST['message'])){
            header("Location:profil.php?receive=" . $_POST['mail']);
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
            $age = $user['age'];
            $work = $user['work'];
            $address = $user['address'];
            $height = $user['height'];
            $weight = $user['weight'];
            $eyes = $user['eyes'];
            $situation = $user['situation'];
            $hairs = $user['hairs'];
            $wish = $user['wish'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="profil_visit.css">
<title>bienvenue</title>
<link rel="icon" href="icon_titre.ico" type="image/gif">
</head>
<body class="body-light">
    <input type="checkbox" id="on">
    <label for="on" class="btn"></label>
    <br><br>
    <div class="header">
        <div class="present">
            <h1> Vous êtes sur la page de <?= $name ?> </h1>
            <p>Sexe : <?= $gender ?></p>
            <p>Age : <?= $age ?></p>
            <p>Travail : <?= $work ?></p>
            <p>Adresse : <?= $address ?></p>
            <p>Taille : <?= $height ?></p>
            <p>Poids : <?= $weight ?></p>
            <p>Yeux : <?= $eyes ?></p>
            <p>Situation : <?= $situation ?></p>
            <p>Cheveux : <?= $hairs ?></p>
            <p>Recherche : <?= $wish ?></p>      
        </div>

        <div>
        <br>
            <p id="video-title"><b>Vidéo préférée de <?= $name ?> :</b></p>
            <!-- The iframe for the YouTube video -->
            <iframe id="youtube-player" width="800" height="500" 
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
        <div class="menu">
            <div class="info-profil">
                <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                    <input type="submit" value="Mon Profil" name="profil">
                </form>
            </div>

            <div class="deco">
                <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                    <input type="submit" value="Deconnexion" name="logout">
                </form>
            </div>
            <div class="info-search">
                <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                    <input type="submit" value="Recherche" name="recherche">
                </form>
            </div>
            <?php if($_POST['mail'] != $_SESSION['mail'] && $_SESSION['sub'] == 1){?>
            <div class="chat">
                <form action="profil.php" method="GET">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                    <button type="submit" value="<?php echo $_POST['mail'] ?>" name="receive">Envoyer un message</button>
                </form>
            </div>
            <?php }?>
        </div>
    </div>
    <script src="script_profil_visit.js"></script>
</body>
</html>