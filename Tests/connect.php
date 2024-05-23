<?php 
 //Nous allons démarrer la session avant toute chose
    require 'session_setup.php';
    $json = 0;
    $account_exist = false;
    if (isset($_SESSION['mail'])){
        header("Location:test.php");
    }
    else{
        if(isset($_POST['boutton-valider'])){ // Si on clique sur le boutton , alors :
            //Nous allons verifiér les informations du formulaire
            if(isset($_POST['email']) && isset($_POST['mdp'])) { //On verifie ici si l'utilisateur a rentré des informations
                //Nous allons mettres l'email et le mot de passe dans des variables
                $email = $_POST['email'] ;
                $mdp = $_POST['mdp'] ;
                $erreur = "" ;
                //Nous allons verifier si les informations entrée sont correctes
                //Connexion a la base de données
                if(file_exists('./Comptes/'.$email.'.json')){
                    $json = json_decode(file_get_contents('./Comptes/'.$email.'.json'), true);
                    $account_exist = true;
                }
                else{
                    $erreur = "Adresse Mail ou Mots de passe incorrectes !";
                }
                //requete pour selectionner  l'utilisateur qui a pour email et mot de passe les identifiants qui ont été entrées
                if ($erreur == "" && $json['mail'] == $email && $json['mdp'] == $mdp){
                        session_setup(3, $json);
                        header("Location:test.php");
                }
                else{
                    $erreur = "Adresse Mail ou Mots de passe incorrectes !";
                }
            }
        }
    }
    if(isset($_POST['retour'])){
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connect.css">
</head>
<body class="body-light">
    <div class="title" id="titre_sign-in">
        <h1 id="moving-text">Connexion</h1>
    </div>
    <section>
        <?php 
            if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
                echo "<p class= 'Erreur'>".$erreur."</p>"  ;
            }
        ?>
        <div class="sign-in">
            <form class="login-bloc" action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
                <label id="adressemail">Adresse Mail</label>
                <br>
                <input type="email" name="email">
                <br>
                <label id="motdepasse">Mots de Passe</label>
                <br>
                <input type="password" name="mdp">
                <br>
                <input type="submit" value="Valider" name="boutton-valider">
            </form>
        </div>
    </section> 
    <form class="btn" action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Retour" name="retour">
    </form>
    <script src="script_connect.js"></script>
</body>
</html>