<?php
    function connect()
    {
        //se connecter à la base de données
        $connexion = mysqli_connect("localhost", "root", "", "tp2");

        if(!$connexion)
        {
            trigger_error("Erreur de connexion : " . mysqli_connect_error());
        }

        mysqli_query($connexion, "SET NAMES 'UTF8'");
        return $connexion;
    }

    function fermer_connexion()
    {
        global $connexion;
        mysqli_close($connexion);
    }
    
    $connexion = connect();

    // ici c'est la fonction pour permettre à l'usager de se connecter et de proteger l'usager
    function login($usager, $motDePasse)
    {
        global $connexion;
        // rediriger la requete
        $requete = "SELECT * FROM usager WHERE nomUsager=? AND motDePasse=?";
        // préparer la requête
        $reqPrep = mysqli_prepare($connexion, $requete);

        if($reqPrep)
        {
            mysqli_stmt_bind_param($reqPrep, "ss", $usager, $motDePasse);

            // exécuter la requête
            mysqli_stmt_execute($reqPrep);

            // obtenir le résultat de la requête
            $resultat = mysqli_stmt_get_result($reqPrep);

            // si il y a un match, on renvoie true sinon false
            if(mysqli_num_rows($resultat) > 0) 
            {
                return true;
            }
            else
            {
                return false;
            }
            
        }
    }

    function rechercheArticle($recherche)
    {
        global $connexion;

        $requete = "SELECT * FROM article WHERE article.titre=? OR article.texte=? OR article.idUsager=?";

        //exécution de la requête
        $reqPrep = mysqli_prepare($connexion, $requete);
        mysqli_stmt_bind_param($reqPrep, 'sss', $recherche, $recherche, $recherche);
        mysqli_stmt_execute($reqPrep);
        $resultat = mysqli_stmt_get_result($reqPrep);

        if (mysqli_num_rows($resultat) > 0)
            return $resultat;
        else
            return false;
    }

    function genereArticles()
    {
        global $connexion;
        $requete = "SELECT * FROM article";
        $resultat = mysqli_query($connexion, $requete);

        while ($rangee = mysqli_fetch_assoc($resultat))
        {
            echo "<h2>" . htmlspecialchars($rangee["titre"]) . "</h2>";
            echo "<p>" . htmlspecialchars($rangee["texte"]) . "</p>";
            echo "<p>" . htmlspecialchars($rangee["idUsager"]) . "</p>";
        }
    }
    
    
    ?>