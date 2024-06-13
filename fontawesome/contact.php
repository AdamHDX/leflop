<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,600;1,600&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
        <link rel="icon" href="Images/logo.png">
        <title>Le Flop !</title>
        <link rel="stylesheet" href="CSS/reset.css">
        <link rel="stylesheet" href="CSS/header.css">
        <link rel="stylesheet" href="CSS/layout.css">
        <link rel="stylesheet" href="CSS/contact.css">
        <link rel="stylesheet" href="CSS/footer.css">
    </head>

<body>

<header class="navbar">

    <div class="Logo">
        <a href="index.html">
        <img src="Images/Ellipse1.png" id="Ellipse1" alt="Ellipse1">
        <img src="Images/Logo_agence.png" id="Logo" alt="Logo_agence">
        </a>
    </div>
    
    <div class="Menu">
        <a href="index.html" class="header">ACCUEIL</a>
        <a href="agence.html" class="header">AGENCE</a>
        <a href="missions.html" class="header">MISSIONS</a>
        <a href="contact.php" class="header">CONTACT</a>
    </div>
        <a href="missions.html#sectionmissions" class="boutoninscription">S'INSCRIRE</a>
    </header>

    <div class="cadre">
    <?php
        // Pour se connecter à la BDD "beiningl"
        $serveur = "192.168.135.113";
        $utilisateur = "beiningl";
        $mdp = "sacmej-hujzE4-hubqiw";
        $base = "beiningl";
        $port = 3306;
        
        // Connexion à la base de données
        $lienBase = mysqli_connect($serveur, $utilisateur, $mdp, $base, $port); 
        
        // Vérification de la connexion
        if (!$lienBase) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        // Vérification si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $nom = mysqli_real_escape_string($lienBase, $_POST['nom']);
            $prenom = mysqli_real_escape_string($lienBase, $_POST['prenom']);
            $objet = mysqli_real_escape_string($lienBase, $_POST['objet']);
            $mail = mysqli_real_escape_string($lienBase, $_POST['mail']);
            $message = mysqli_real_escape_string($lienBase, $_POST['message']);

            // Requête SQL pour insérer les données
            $sql = "INSERT INTO contact (nom_contact, prenom_contact, objet_contact, mail_contact, message_contact) VALUES ('$nom', '$prenom','$objet', '$mail', '$message')";

            // Exécution de la requête et vérification du succès
            if (mysqli_query($lienBase, $sql)) {
                echo "Message envoyé avec succès!";
            } else {
                echo "Erreur lors de l'insertion : " . mysqli_error($lienBase);
            }

            // Fermeture de la connexion
            mysqli_close($lienBase);
        } 
        ?>


        <h1 id="contact">NOUS CONTACTER</h1><br>
    <form id="formulaire" action="contact.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Nom" required>

        <label for="surname">Prénom :</label>
        <input type="text" id="nom" name="prenom" placeholder="Prénom" required>
    
        <!--Champ pour l'objet du mail-->
        <label for="objet">Objet :</label>
        <input type="text" id="sujet" name="objet" placeholder="Objet" required>

        <!--Champ pour l'adresse mail-->
        <label for="emailAddress">E-mail :</label>
        <input id="emailAddress" type="email" name="mail" placeholder="E-mail" required>
    
        <!--Champ pour le message-->
        <label for="message">Message :</label>
        <textarea id="message" name="message" placeholder="Message" style="height:150px" required></textarea>
    
        <!--Bouton d'envoie du formulaire-->
        <input type="submit" value="Envoyer">


      </form>
    </div>


<!--Début de mon footer-->
<footer>
    <div class="logofooter">
        <img src="Images/logo.png" alt="logoagence" id="logofooter">
    </div>

    <div class="pages">
        <h2 class="titrefooter">Pages :</h2>
        <ul>
            <li><a href="index.html" class="txtfooter">Acceuil</a></li>
            <li><a href="agence.html" class="txtfooter">Agence</a></li>
            <li><a href="missions.html" class="txtfooter">Missions</a></li>
            <li><a href="contact.php" class="txtfooter">Contact</a></li>
        </ul>
    </div>
    <div class="adresse">
        <h2 class="titrefooter">Adresse :</h2>
        <a href="https://maps.app.goo.gl/L1GLxhhD5h5DUc8c9"><h2 class="txtfooter">28 Av. du Lac d'Annecy,<br>73370<br>Le Bourget du Lac.</h2></a>
    </div>
    <div class="follow">
        <h2 class="titrefooter1">Suivez nous :</h2>
        <a href="https://www.instagram.com/agence_leflop?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="><img src="Images/insta.png" alt="insta" id="insta"></a>
    </div>
</footer>
    <!--Fin de mon footer-->
    
</body>
</html>