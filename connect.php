<?php 
 //Nous allons démarrer la session avant toute chose
    session_start() ;
    $json = 0;
    $account_exist = false;
    $id = 1;
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
                    header("Location:test.php");
                    $erreur = "Adresse Mail ou Mots de passe incorrectes !";
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
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <section>
       <h1> Connexion</h1>
       <?php 
       if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
           echo "<p class= 'Erreur'>".$erreur."</p>"  ;
       }
       ?>
       <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
           <label>Adresse Mail</label>
           <input type="email" name="email">
           <label >Mots de Passe</label>
           <input type="password" name="mdp">
           <input type="submit" value="Valider" name="boutton-valider">
       </form>
   </section> 
   <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
        <input type="submit" value="Retour" name="retour">
   </form>
</body>
</html>