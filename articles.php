<?php
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
require_once("fonctionsDB.php");
$message = "";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page d'affichage des articles</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body>
    <header>
        <h3><a href="authentification.php">Authentification</a></h3>
        <h1>Mon blog</h1>
        <form method="POST">
            Entrez votre recherche : <input type="text" name="recherche">
            <input type="submit" name="rechercher" value="rechercher"><br>
            <?php
            // Envoie du message
            if (isset($message))
                echo "<span>$message</span>";
            ?>
        </form>
    </header>
    <div class="articles">
        <?php
        /* Verfier que l'on arrive bien du formulaire et si celui-ci contient de l'information */
        if (isset($_POST["rechercher"])) {
            if (trim($_POST["recherche"]) != "") {
                $recherche = "%" . $_POST["recherche"] . "%";
                rechercheArticle($_POST["recherche"]);
            }
        }
        else
        genereArticles();
        ?>
    </div>
</body>

</html>