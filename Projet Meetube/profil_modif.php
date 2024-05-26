<?php // a completer
require_once 'session_setup.php';
$id = 0;
function calculerAge($dateNaissance) : int {
    // Convertir les dates en objets DateTime
    $dateNaissance = new DateTime($dateNaissance);
    $dateAujourdhui = new DateTime();

    // Calculer la différence entre les deux dates
    $difference = $dateNaissance->diff($dateAujourdhui);

    // Récupérer l'âge à partir de la différence
    return $difference->y;
}


if (isset($_POST['sent'])){
    $json = json_decode(file_get_contents("./Comptes/{$_SESSION['mail']}.json"), true);
    if($_POST['ytb_video'] != ""){
        $json['ytb_video'] = $_POST['ytb_video'];
    }

    if($_POST['height'] != ""){
        $json['height'] = $_POST['height'];
    }

    if($_POST['eyes'] != ""){
        $json['eyes'] = $_POST['eyes'];
    }

    if($_POST['work'] != ""){
        $json['work'] = $_POST['work'];
    }
    if($_POST['address'] != ""){
        $json['address'] = $_POST['address'];
    }
    if($_POST['situation'] != ""){
        $json['situation'] = $_POST['situation'];
    }
    if($_POST['weight'] != ""){
        $json['weight'] = $_POST['weight'];
    }
    if($_POST['wish'] != ""){
        $json['wish'] = $_POST['wish'];
    }
    if($_POST['password'] != ""){
        $json['password'] = $_POST['password'];
    }
    session_setup(3, $json);
    file_put_contents("./Comptes/{$_SESSION['mail']}.json", json_encode($json));
    $users = json_decode(file_get_contents('./Comptes/users.json'), true);
    while ($users[$id]['mail'] != $_SESSION['mail']){
        $id ++;
    }
    if($_POST['ytb_video'] != "") {
        $users[$id]['ytb_video'] = $_POST['ytb_video'];
    }
    if($_POST['wish'] != "") {
        $users[$id]['wish'] = $_POST['wish'];
    }
    file_put_contents('./Comptes/users.json', json_encode($users));
    header("Location:profil.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifiez votre profil</title>
    <link rel="icon" href="icon_titre.ico" type="image/gif">
    <link rel="stylesheet" href="register_part2.css">
</head>
<body class="body-light">
<input type="checkbox" id="on">
<label for="on" class="btn"></label>
<div class="title" id="titre_sign-in">
    <h1 id="moving-text">Un peu plus sur vous :</h1>
</div>
<section>
    <div class="sign-in">
        <form class="login-bloc" action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <label>Le lien de votre video Youtube préférée</label>
            <input type="url" name="ytb_video">
            <br>
            <label>Votre profession : </label>
            <input type="text" name="work">
            <br>
            <label>Votre lieu de résidence: </label>
            <input type="text" name="address">
            <br>
            <label>Votre situation amoureuse:</label>
            <select name="situation">
                <option value="" disabled selected hidden>Sélectionnez une option</option>
                <option value="Célibataire"> Célibataire </option>
                <option value="En couple"> En couple </option>
                <option value="Veuf/Veuve"> Veuf/Veuve </option>
                <option value="Divorce"> Divorcé </option>
            </select>
            <br>
            <label>Votre poids en kg:</label>
            <input type="number" name="weight" >
            <br>
            <label>Votre taille en cm :</label>
            <input type="number" name="height" >
            <br>
            <label>La couleur de vos cheveux :</label>
            <input type="text" name="hairs">
            <br>
            <label>Je cherche :</label>
            <select name="wish">
                <option value="" disabled selected hidden>Sélectionnez une option</option>
                <option value="Serieux"> Sérieux </option>
                <option value="Pas de prise de tete"> Pas de prise de tete </option>
                <option value="Ne sais pas"> Je ne sais pas </option>
                <option value="Coup d'un soir"> Coup d'un soir </option>
            </select>
            <br>
            <label>Changer votre mot de passe:</label>
            <input type="password" name="password" >
            <br>
            <input id="valider" type="submit" value="Valider" name="sent">

        </form>
    </div>
</section>
<script src="script_register_part2.js"></script>
</body>
</html>
