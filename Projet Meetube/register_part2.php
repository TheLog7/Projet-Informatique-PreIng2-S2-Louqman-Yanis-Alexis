<?php // a completer
require_once 'session_setup.php';
$id = 0;  
function calculerAge($datebirthday) : int {
    // Convertir les dates en objets DateTime
    $datebirthday = new DateTime($datebirthday);
    $datetoday = new DateTime();

    // Calculer la différence entre les deux dates
    $difference = $datebirthday->diff($datetoday);

    // Récupérer l'âge à partir de la différence
    return $difference->y;
}


if (isset($_POST['sent'])){
    $json = json_decode(file_get_contents("./Comptes/{$_SESSION['mail']}.json"), true);
    $json['birthday'] = $_POST['birthday'];
    $json['age'] = calculerAge($_POST['birthday']);
    $json['genre'] = $_POST['genre'];
    $json['ytb_video'] = $_POST['ytb_video'];
    $json['work'] = $_POST['work'];
    $json['address'] = $_POST['address'];
    $json['situation'] = $_POST['situation'];
    $json['height'] = $_POST['height'];
    $json['weight'] = $_POST['weight'];
    $json['eyes'] = $_POST['eyes'];
    $json['hairs'] = $_POST['hairs'];
    $json['wish'] = $_POST['wish'];
    session_setup(2, $json);
    file_put_contents("./Comptes/{$_SESSION['mail']}.json", json_encode($json));
    $users = json_decode(file_get_contents('./Comptes/users.json'), true);
    while (isset($users[$id])){
        $id ++;
    }
    $id --;
    $users[$id]['ytb_video'] = $_POST['ytb_video'];
    $users[$id]['genre'] = $_POST['genre'];
    $users[$id]['age'] = calculerAge($_POST['birthday']);
    $users[$id]['wish'] = $_POST['wish'];
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
    <title>Un peu plus sur vous</title>
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
                <label>Vous etes :</label>
                <select name="genre" required>
                    <option value="" disabled selected hidden>Sélectionnez une option</option>
                    <option value="homme"> un homme</option>
                    <option value="femme">une femme</option>
                </select>
                <br>
                <label>Vous etes né le : </label>
                <input type="date" name="birthday" required>
                <br>
                <label>Le lien de votre video Youtube préférée</label>
                <input type="url" name="ytb_video" required>
                <br>
                <label>Votre profession : </label>
                <input type="text" name="work">
                <br>
                <label>Votre lieu de résidence: </label>
                <input type="text" name="address">
                <br>
                <label>Votre situation amoureuse:</label>
                <select name="situation" required>
                    <option value="" disabled selected hidden>Sélectionnez une option</option>
                    <option value="Célibataire"> Célibataire </option>
                    <option value="En couple"> En couple </option>
                    <option value="Veuf/Veuve"> Veuf/Veuve </option>
                    <option value="Divorce"> Divorcé </option>
                </select>
                <br>
                <label>Votre taille en cm :</label>
                <input type="number" name="height" >
                <br>
                <label>Votre poids en kg:</label>
                <input type="number" name="weight" >
                <br>
                <label>La couleur de vos yeux :</label>
                <input type="text" name="eyes" >
                <br>
                <label>La couleur de vos cheveux :</label>
                <input type="text" name="hairs">
                <br>
                <label>Je cherche :</label>
                <select name="wish" required>
                    <option value="" disabled selected hidden>Sélectionnez une option</option>
                    <option value="Serieux"> Sérieux </option>
                    <option value="Pas de prise de tete"> Pas de prise de tete </option>
                    <option value="Ne sais pas"> Je ne sais pas </option>
                    <option value="Coup d'un soir"> Coup d'un soir </option>
                </select>
                <br>
                <input id="valider" type="submit" value="Valider" name="sent">

            </form>
        </div>
    </section>
<script src="script_register_part2.js"></script>
</body>
</html>
