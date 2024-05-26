<?php
    session_start();

    if(isset($_POST['recherche'])){
        header("Location:search.php");
    }

    if($_SESSION['mail'] == 'femme'){
        $_SESSION['sub'] = 1;
        $json = json_decode(file_get_contents('./Comptes/'.$_SESSION['mail'].'.json'), true);
        $json['sub'] = 1;
        file_put_contents('./Comptes/'.$_SESSION['mail'].'.json', json_encode($json));
        header('Location:profil.php');
    }

    if(isset($_POST['profil'])){
        $_SESSION['sub'] = 1;
        $json = json_decode(file_get_contents('./Comptes/'.$_SESSION['mail'].'.json'), true);
        $json['sub'] = 1;
        file_put_contents('./Comptes/'.$_SESSION['mail'].'.json', json_encode($json));
        header('Location:profil.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="subscription.css">
    <link rel="icon" href="icon_titre.ico" type="image/gif">
    <title>bienvenue</title>
</head>
<body class="body-light">
    <input type="checkbox" id="on">
    <label for="on" class="theme"></label>

    <div class="header">
        <h1> Page d'abonnement</h1>
            <br><br>
        <div class="info-profil">
            <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <input type="submit" value="S'abonner ( 5 euros / 6 mois )" name="profil">
            </form>
        </div>
        <div class="deco">
            <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <input type="submit" value="Deconnexion" name="logout">
            </form>
        </div>
    </div>
    <script src="script_subscription.js"></script>
</body>
</html>