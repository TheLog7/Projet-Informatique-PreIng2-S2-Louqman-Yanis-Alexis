<?php // a completer
require_once 'session_setup.php';
$id = 0;

function calculerAge($dateNaissance) {
    // Convertir les dates en objets DateTime
    $dateNaissance = new DateTime($dateNaissance);
    $dateAujourdhui = new DateTime();

    // Calculer la différence entre les deux dates
    $difference = $dateNaissance->diff($dateAujourdhui);

    // Récupérer l'âge à partir de la différence
    $age = $difference->y;

    return $age;
}

if (isset($_POST['sent'])){
    $json = json_decode(file_get_contents("./Comptes/{$_SESSION['mail']}.json"), true);
    $json['genre'] = $_POST['genre'];
    $json['birthday'] = calculerAge($_POST['birthday']);
    $json['ytb_video'] = $_POST['ytb_video'];
    session_setup(2, $json);
    file_put_contents("./Comptes/{$_SESSION['mail']}.json", json_encode($json));
    $users = json_decode(file_get_contents('./Comptes/users.json'), true);
    while (isset($users[$id])){
        $id ++;
    }
    $id --;
    $users[$id]['ytb_video'] = $_POST['ytb_video']; 
    $users[$id]['genre'] = $_POST['genre'];
    $users[$id]['birthday'] = $_POST['birthday'];
    file_put_contents('./Comptes/users.json', json_encode($users));
    header("Location:test.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un peu plus sur vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>
    <h1> Un peu plus sur vous :</h1>
    <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
        <label>Vous etes :</label>
        <select name="genre" required>
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
        <input type="submit" value="Valider" name="sent">
    </form>
</section>
<form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
    <input type="submit" value="Retour" name="retour">
</form>
</body>
</html>
