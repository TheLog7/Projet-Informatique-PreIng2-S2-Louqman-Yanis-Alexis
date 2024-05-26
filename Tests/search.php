<?php
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: index.php");
        exit;
    }

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
    <link rel="icon" href="icon_titre.ico" type="image/gif">
</head>
<body class="body-light">
    <div class="title" id="titre_sign-in">
        <h1 id="moving-text">&nbsp;&nbsp;&nbsp;Recherche</h1>
    </div>
    <br>
    <input type="checkbox" id="on">
    <label for="on" class="btn"></label>
    <br>
    <br>
    <div class="info-profil">
        <form class="bouton-style" action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Mon Profil" name="profil">
        </form>
    </div>
    <br>
    <div>
        <form class="bouton-style" action="logout.php" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
            <input type="submit" value="Deconnexion" name="logout">
        </form>
    </div>
    <br>

    <div class="search-wrapper">
    <input type="search" id="search" placeholder="Entrez le compte que vous recherchez" data-search>
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
            const videoUrl = user.ytb_video;
            const videoId = getVideoId(videoUrl);
            const embedUrl = `https://www.youtube.com/embed/${videoId}`;
            video.innerHTML = `<iframe width="450" height="253" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;

            function getVideoId(url) {
                const regex = /(?:https?:\/\/(?:www\.)?youtube\.com\/watch\?v=|https?:\/\/youtu\.be\/)([\w-]+)/;
                const match = url.match(regex);
                if (match) {
                    return match[1];
                }
                return null;
            }
            
            card.addEventListener("click", () => {
                const user = users.find(u => u.element === card);
                const formData = new FormData();
                formData.append('name', user.name);
                formData.append('mail', user.mail);
                formData.append('ytb_video', user.ytb_video);
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'profil_visit.php';
                form.style.display = 'none';
                for (const [key, value] of formData.entries()) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = value;
                    form.appendChild(input);
                }
                document.body.appendChild(form);
                form.submit();
            });

            userCardContainer.append(card)
            return { name: user.name, mail: user.mail, ytb_video: user.ytb_video, element: card }
            })
        })
    </script>
    <script src="script_search.js"></script>
</body>
</html>

