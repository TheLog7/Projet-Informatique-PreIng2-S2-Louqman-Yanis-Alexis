<?php

    if(isset($_POST['profil'])){
        header("Location:profil.php");
    }

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
        <form action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Deconnexion" name="logout">
        </form>
    </div>

    <div class="info-profil">
        <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Profil" name="profil">
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
        <div class="video" data-video></div>
        </div>
    </template>

    <script>
        const userCardTemplate = document.querySelector("[data-user-template]")
        const userCardContainer = document.querySelector("[data-user-cards-container]")
        const searchInput = document.querySelector("[data-search]")

        let users = []

        searchInput.addEventListener("input", e => {
        const value = e.target.value.toLowerCase()
        users.forEach(user => {
            const isVisible =
            user.name.toLowerCase().includes(value) ||
            user.mail.toLowerCase().includes(value)
            user.element.classList.toggle("hide", !isVisible)
        })
        })

        fetch("Comptes/users.json")
        .then(res => res.json())
        .then(data => {
            users = data.map(user => {
            const card = userCardTemplate.content.cloneNode(true).children[0]
            const header = card.querySelector("[data-header]")
            const body = card.querySelector("[data-body]")
            const video = card.querySelector("[data-video]")
            header.textContent = user.name
            body.textContent = user.mail
            video.textContent = user.ytb_video
            userCardContainer.append(card)
            return { name: user.name, mail: user.mail, ytb_video: user.ytb_video, element: card }
            })
        })
    </script>
</body>
</html>

