<?php
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
    require_once("fonctionsDB.php");
    $message = "";

/* Verfier que l'on arrive bien du formulaire et si celui-ci contient de l'information */
    if (isset($_POST["rechercher"])) 
    {
        if (trim($_POST["recherche"]) != "") 
        {
            $recherche = "%" . $_POST["recherche"] . "%";
            $resultat = rechercheArticle($recherche);

            $resultat = rechercheArticle($resultat);
            fermer_connexion();
        } 
        else
            $message = "Veuillez entrer une recherche";
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page d'affichage des articles</title>
</head>

<body>
    <header>
        <h1>Mon blog</h1>
        <h3><a href="authentification.php">Authentification</a></h3>
        <form method="POST">
            Entrez votre recherche : <input type="text" name="recherche">
            <input type="submit" name="rechercher" value="rechercher">
            <?php
            // Envoie du message
            if (isset($message))
                echo "<p>$message</p>";
            ?>
        </form>
    </header>
    <div class="articles">
        <?php
            genereArticles();
        ?>
    </div>
</body>

</html>