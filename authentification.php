<?php
//ici j'inclu le fichier des fonctions et connexion à la base de donnée
require_once("fonctionsDB.php");
// Si le formulaire à été rempli puis envoyé
if (isset($_POST["connecter"])) {
    if (!empty($_POST["usager"] && !empty($_POST["password"]))) {
        $test = login($_POST["usager"], $_POST["password"]);

        if ($test) {
            header("location: articles.php");
            die();
        }
    } else
        $message = "Veuillez entrer un nom d'usager et mot de passe valide";
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Page d'identification</title>
    <link rel="stylesheet" href="main.css" />
</head>

<body>
    <div class="form">
        <form method="POST">
            Nom d'usager : <br><input type="text" name="usager"><br>
            Mot de passe : <br><input type="password" name="password"><br>
            <input type="submit" name="connecter" value="connecter"><br>
        </form>
        <?php
        if (isset($message))
            echo "<span>$message</span>";
        ?>
    </div>
</body>

</html>