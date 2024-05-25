<?php
    session_start();
    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }
   
    if(isset($_POST['profil'])){
        header("Location:profil.php");
    }
    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }
    if(isset($_POST['chat'])){
        header("Location:chat_index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="icon" href="icon_titre.ico" type="image/gif">
    <title>bienvenue</title>
</head>
<body class="body-light">
    <input type="checkbox" id="on">
    <label for="on" class="btn"></label>

    <div class="header">
        <h1> Accueil et page d'abonnement</h1>
            <br><br>
        <div class="info-profil">
            <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <input type="submit" value="Profil" name="profil">
            </form>
        </div>
        <div class="info-search">
            <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <input type="submit" value="Recherche" name="recherche">
            </form>
        </div>
        <div class="deco">
            <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <input type="submit" value="Deconnexion" name="logout">
            </form>
        </div>
    </div>
    <script src="script_test.js"></script>
</body>
</html>