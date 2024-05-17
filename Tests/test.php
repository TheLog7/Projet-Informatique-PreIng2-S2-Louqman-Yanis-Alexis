<?php
    session_start();
    echo 'Bonjour '. $_SESSION['nom']. '<br> Voici votre adresse mail : '. $_SESSION['mail'];
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location:index.php");
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
    <title>bienvenue</title>
</head>
<body>
    <div>
    <h1> Accueil</h1>
    <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
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