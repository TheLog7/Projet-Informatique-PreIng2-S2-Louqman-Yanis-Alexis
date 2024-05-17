<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css">
    <title>bienvenue</title>
</head>
<body>
    <h1> Accueil</h1>

    <div>
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Deconnexion" name="logout">
        </form>
    </div>

    <div class="search-wrapper">
    <label for="search">Search Users</label>
    <input type="search" id="search" data-search>
    </div>

    <div class="user-cards" data-user-cards-container></div>

    <template data-user-template>
        <div class="card">
        <div class="header" data-header></div>
        <div class="body" data-body></div>
        </div>
    </template>

    <script src="script_search.js"></script>
</body>
</html>

