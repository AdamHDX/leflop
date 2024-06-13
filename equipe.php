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
    <link rel="stylesheet" href="CSS/breadcrumb.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/equipe.css">
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

    <div class="boutonretour">
        <a href="missions.html" class="btnretour"> < Retour </a></div>                     
    </div>

    <div class="cadre">

        <h1 id="contact">S'INSCRIRE</h1><br>
    <form id="formulaire" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
>
        <label for="nom">Chef d'équipe :</label>
        <input type="text" id="nom" name="nom" placeholder="Nom" required>
        <input type="text" id="surname" name="prenom" placeholder="Prénom" required>

        <!--Champ pour l'adresse mail-->
        <label for="emailAddress">E-mail :</label>
        <input id="emailAddress" type="email" name="mail" placeholder="E-mail du chef d'équipe" required>

        <label for="nom">Equipe :</label>
        <input type="text" id="nom" name="nom_equipe" placeholder="Nom de l'équipe" required>


        <label for="nom">Membres d'équipe :</label>

        <div class="colonne">
        <input type="text" id="membre" name="membre1" placeholder="Nom et Prénom" required>
        <input type="text" id="membre" name="membre2" placeholder="Nom et Prénom" required>
        <input type="text" id="membre" name="membre3" placeholder="Nom et Prénom" required>   
        <input type="text" id="membre" name="membre4" placeholder="Nom et Prénom" >
        <input type="text" id="membre" name="membre5" placeholder="Nom et Prénom" >
        </div>


        <label for="horaire">Horaire :</label>
            <select id="horaire" name="idHoraire" required>
                <?php
                // Connexion à la base de données
                $serveur = "192.168.135.113";
                $utilisateur = "beiningl";
                $mdp = "sacmej-hujzE4-hubqiw";
                $base = "beiningl";
                $port = 3306;

                $lienBase = mysqli_connect($serveur, $utilisateur, $mdp, $base, $port);

                if (!$lienBase) {
                    die("Erreur de connexion : " . mysqli_connect_error());
                }

                // Requête pour récupérer les horaires
                $sqlHoraires = "SELECT id_planning, horaires FROM planning";
                $resultHoraires = mysqli_query($lienBase, $sqlHoraires);

                if ($resultHoraires) {
                    while ($horaire = mysqli_fetch_assoc($resultHoraires)) {
                        echo "<option value='" . htmlspecialchars($horaire['id_planning'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($horaire['horaires'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun horaire disponible</option>";
                }
                ?>
            </select><br><br>

            <label for="jeu">Jeu :</label>
            <select id="jeu" name="idJeu" required>
                <?php
                // Requête pour récupérer les noms des jeux
                $sqlJeux = "SELECT id_jeux, nom FROM jeux";
                $resultJeux = mysqli_query($lienBase, $sqlJeux);

                if ($resultJeux) {
                    while ($jeu = mysqli_fetch_assoc($resultJeux)) {
                        echo "<option value='" . htmlspecialchars($jeu['id_jeux'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($jeu['nom'], ENT_QUOTES, 'UTF-8') . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun jeu disponible</option>";
                }

                mysqli_close($lienBase);
                ?>
            </select><br><br>

            <!-- Bouton d'envoi du formulaire -->
            <input type="submit" value="Envoyer" name="ajouter_reservation">

      </form>
    </div>

    <?php
if (isset($_POST['ajouter_reservation'])) {
    // Connexion à la base de données
    $lienBase = mysqli_connect($serveur, $utilisateur, $mdp, $base, $port);

    // Vérification de la connexion
    if (!$lienBase) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Récupération et échappement des données POST
    $nom = mysqli_real_escape_string($lienBase, $_POST['nom']);
    $prenom = mysqli_real_escape_string($lienBase, $_POST['prenom']);
    $mail = mysqli_real_escape_string($lienBase, $_POST['mail']);
    $nom_equipe = mysqli_real_escape_string($lienBase, $_POST['nom_equipe']);
    $membre1 = mysqli_real_escape_string($lienBase, $_POST['membre1']);
    $membre2 = mysqli_real_escape_string($lienBase, $_POST['membre2']);
    $membre3 = mysqli_real_escape_string($lienBase, $_POST['membre3']);
    $membre4 = mysqli_real_escape_string($lienBase, $_POST['membre4']);
    $membre5 = mysqli_real_escape_string($lienBase, $_POST['membre5']);
    $idHoraire = mysqli_real_escape_string($lienBase, $_POST['idHoraire']);
    $idJeu = mysqli_real_escape_string($lienBase, $_POST['idJeu']);



    // Utilisation de transactions pour assurer l'intégrité des données
    mysqli_begin_transaction($lienBase);

    try {
        // Requête SQL pour insérer un joueur
        $sqlInsertJoueur = "INSERT INTO joueurs (nom, prenom, mail) VALUES ('$nom', '$prenom', '$mail')";
        if (!mysqli_query($lienBase, $sqlInsertJoueur)) {
            throw new Exception("Erreur lors de l'insertion du joueur : " . mysqli_error($lienBase));
        }

        // Récupérer l'ID du joueur inséré
        $joueur_id = mysqli_insert_id($lienBase);

        // Requête SQL pour insérer une équipe
        $sqlInsertEquipe = "INSERT INTO equipes (nom, membre1, membre2, membre3, membre4, membre5) VALUES ('$nom_equipe', '$membre1', '$membre2', '$membre3', '$membre4', '$membre5')";
        if (!mysqli_query($lienBase, $sqlInsertEquipe)) {
            throw new Exception("Erreur lors de l'insertion de l'équipe : " . mysqli_error($lienBase));
        }

        // Récupérer l'ID de l'équipe insérée
        $equipe_id = mysqli_insert_id($lienBase);

        // Requête SQL pour insérer dans la table d'association
        $sqlInsertAssociation = "INSERT INTO joueurs_has_equipes (id_joueurs, id_equipes) VALUES ('$joueur_id', '$equipe_id')";
        if (!mysqli_query($lienBase, $sqlInsertAssociation)) {
            throw new Exception("Erreur lors de l'insertion dans l'association : " . mysqli_error($lienBase));
        }

        // Requête SQL pour insérer dans la table reservations
        $requeteMaxIdReservation = "SELECT MAX(id_reservations) AS max_id FROM reservations";
        $resultatMaxIdReservation = mysqli_query($lienBase, $requeteMaxIdReservation);
        $rowMaxIdReservation = mysqli_fetch_assoc($resultatMaxIdReservation);
        $newIdReservation = $rowMaxIdReservation['max_id'] + 1;

        $sqlInsertReservation = "INSERT INTO reservations (id_reservations, equipe_id_equipe, planning_id_planning, jeux_id_jeux) VALUES ('$newIdReservation', '$equipe_id', '$idHoraire', '$idJeu')";
        if (!mysqli_query($lienBase, $sqlInsertReservation)) {
            throw new Exception("Erreur lors de l'insertion de la réservation : " . mysqli_error($lienBase));
        }

        // Valider la transaction
        mysqli_commit($lienBase);
        echo "<script>alert('La réservation a été ajoutée avec succès.');</script>";

    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        mysqli_rollback($lienBase);
        echo "<script>alert('Erreur : " . addslashes($e->getMessage()) . "');</script>";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($lienBase);
}
?>




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
</body>

</html>
    