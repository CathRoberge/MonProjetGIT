<?php
session_start();
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
require_once("fonctionsDB.php");

//vérifier que l'on arrive du formulaire
if (isset($_POST["envoyer"])) {
    $titre = trim($_POST["titre"]);
    $texte = trim($_POST["article"]);
    $idUsager = $_SESSION["usager"];

    //valider que le formulaire a bien été rempli
    if ($titre != "" && $texte != "") {

        $ajout = ajoutArticle($titre, $texte, $idUsager);

        if ($ajout) {
            header("Location: listeEquipes.php");
            die();
        } else
            $message = "Veuillez entrer les informations";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page de modification d'article</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body>
    <header>
        <h1>Modifier un article</h1>
    </header>
    <div class="articles">
        <form method="POST">
            <h2>titre</h2>
            <input type="text" name="titre">
            <h2>article</h2>
            <textarea name="article" id="article" cols="100" rows="10"></textarea><br>
            <input type="submit" name="envoyer">
        </form>
    </div>
</body>