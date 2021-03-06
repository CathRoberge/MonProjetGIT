<?php
session_start();
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
require_once("fonctionsDB.php");
$message = "";
$usager = $_SESSION["usager"];

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
        <h1><a href="articles.php">Mon blogue</a></h1>
        <form method="POST">
            <input type="text" name="recherche">
            <input type="submit" name="rechercher" value="rechercher"><br>

        </form>
        <div class="connexion">
            <h3><a href="authentification.php">Connexion</a></h3>
            <h3><a href="deconnexion.php">Deconnexion</a></h3>
        </div>
    </header>
    <div class="articles">
        <?php
        if (!empty($_SESSION["usager"])) {
            echo "<div><h3><a href='ajoutArticle.php'>Ajouter un article</a></h3></div>";
        }

        /* Verfier que l'on arrive bien du formulaire et si celui-ci contient de l'information */
        if (isset($_POST["rechercher"])) {
            if (trim($_POST["recherche"]) != "") {
                $recherche = "%" . $_POST["recherche"] . "%";
                rechercheArticle($_POST["recherche"]);
            } else echo "<span>veuillez entrer une recherche</span>";
        } else
            genereArticles($usager);
        ?>
    </div>
</body>

</html>