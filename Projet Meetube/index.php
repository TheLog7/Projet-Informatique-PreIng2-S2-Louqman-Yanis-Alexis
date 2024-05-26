<?php
session_start();
if(isset($_SESSION['mail'])){
    header("Location:profil.php");
}

// Récupération du paramètre d'erreur de l'URL
$error = $_GET['error'] ?? '';

// Si le paramètre d'erreur indique que l'e-mail existe déjà
if ($error === 'email_exists') {
    echo '<script>alert("L\'adresse e-mail existe déjà. Veuillez utiliser une autre adresse e-mail.");</script>';
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Meetube - inscription/connexion</title>
    <link rel="icon" href="icon_titre.ico" type="image/gif">
</head>

<body class="body-light">
    <input type="checkbox" id="on">
    <label for="on" class="btn"></label>
    
    <div class="title" id="titre_sign-in">
        <h1 id="moving-text">&nbsp;Meetube</h1>
    </div>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="register.php" method="post">
                <h1>Créer un compte</h1>
                <input type="text" name="r_name" placeholder="NOM Prénom">
                <input type="email" name="r_mail" placeholder="Email">
                <input type="password" name="r_password" placeholder="Mot de passe">
                <input type="submit" class="conreg" name="sinscrire" value="S'inscrire">
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="connect.php" method="post">
                <h1>Connectez-vous</h1>
                <a href="#">Vous avez oublié votre mot de passe ?</a>
                <input type="submit" class="conreg" name="seconnecter" value="Se connecter">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bonjour !</h1>
                    <p>Connectez-vous si vous avez un compte déjà existant</p>
                    <button class="hidden" id="login">Se connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bienvenue !</h1>
                    <p>Inscrivez-vous pour accéder au site et ses fonctionnalités</p>
                    <button class="hidden" id="register">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>