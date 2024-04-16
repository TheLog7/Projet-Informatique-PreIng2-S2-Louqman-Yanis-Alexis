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
        <h1 id="moving-text">Meetube</h1>
    </div>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Créer un compte</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>ou utiliser votre mail pour vous inscrire</span>
                <input type="text" placeholder="Nom">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Mot de passe">
                <button>S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Connectez-vous</h1>   
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>ou utiliser votre mail de connexion</span>
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Mot de passe">
                <a href="#">Vous avez oublié votre mot de passe ?</a>
                <button>Connexion</button>
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
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>