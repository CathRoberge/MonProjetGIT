<?php
session_start();
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
    require_once("fonctionsDB.php");

    if(isset($_POST["supprimer"]))
    {
        $titre = $_POST["titre"];
        $resultat = supprimerArticle($titre);
    }
?>