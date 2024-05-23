<?php
    session_start();
    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }
    echo "Bonjour {$_SESSION['nom']} <br> Voici votre adresse mail : {$_SESSION['mail']} <br> Vous etes {$_SESSION['situation']} et vous avez les yeux {$_SESSION['eyes']}";
    if(isset($_POST['profil'])){
        header("Location:profil.php");
    }
    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>bienvenue</title>
</head>
<body class="body-light">
    <div>
    <h1> Accueil</h1>
    <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
        <input type="submit" value="Deconnexion" name="logout">
    </form>
    </div>
    <div class="info-search">
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Recherche" name="recherche">
        </form>
    </div>
    <div class="info-profil">
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Profil" name="profil">
        </form>
    </div>
</body>
</html>