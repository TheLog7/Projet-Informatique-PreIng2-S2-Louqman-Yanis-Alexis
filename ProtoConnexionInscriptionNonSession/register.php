<?php
    //$conn = mysqli_connect("localhost", "root", "", "data");
    /*$r_name = $_POST["r_name"];
    $r_mail = $_POST["r_mail"];
    $r_password = $_POST["r_mdp"];

    $conn = new mysqli('localhost', 'root', '','test');
    $stmt = $conn->prepare('insert into profil(name, mail, mdp) values(?, ?, ?)');
    $stmt->bind_param("sss", $r_name, $r_mail, $r_password);
    $stmt->execute();
    echo"registration successful";
    $stmt->close();
    $conn->close();*/
?>

<?php
    $r_name = $_POST["r_name"];
    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'test');

    // Vérification de la connexion
    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $r_mail = $_POST["r_mail"];

        // Requête SQL pour vérifier si l'email est déjà présent dans la base de données
        $sql = "SELECT * FROM profil WHERE mail = '$r_mail'";
        $result = mysqli_query($conn, $sql);

        // Vérification du résultat de la requête
        if (mysqli_num_rows($result) > 0) {
            // L'email est déjà inscrit, afficher un message d'erreur
            header("Location: index.php?error=email_exists");
        } else {
            // L'email n'est pas encore inscrit, procéder à l'inscription
            // Récupération des autres données du formulaire
            $r_password = $_POST["r_mdp"];

            // Insertion des données dans la base de données
            //$sql_insert = "INSERT INTO utilisateurs (email, mot_de_passe) VALUES ('$email', '$motdepasse')";
            $stmt = $conn->prepare('insert into profil(name, mail, mdp) values(?, ?, ?)');
            $stmt->bind_param("sss", $r_name, $r_mail, $r_password);
            $stmt->execute();
            header("Location:test.php") ;
            echo '<script>alert("Inscription réussie !");</script>';
            $stmt->close();
            $conn->close();
        }
    }
?>