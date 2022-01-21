<?php
    function connect()
    {
        //se connecter à la base de données
        $connexion = mysqli_connect("localhost", "e0828186", "XFlpMnMkaGwtajm4iGH7", "tp2");

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
        $requete = "SELECT * FROM usager WHERE ID=? AND motDePasse=?";
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

        $requete = "SELECT * FROM article WHERE article.titre=? OR article.texte=? OR article.idUsager=? ORDER BY article.ID DESC";

        //exécution de la requête
        $reqPrep = mysqli_prepare($connexion, $requete);
        mysqli_stmt_bind_param($reqPrep, 'sss', $recherche, $recherche, $recherche);
        mysqli_stmt_execute($reqPrep);
        $resultat = mysqli_stmt_get_result($reqPrep);

        if (mysqli_num_rows($resultat) > 0)
            while ($rangee = mysqli_fetch_assoc($resultat)) 
            {
                echo "<div><h2>" . htmlspecialchars($rangee["titre"]) . "</h2>
                <p>" . htmlspecialchars($rangee["texte"]) . "</p>
                <p>" . htmlspecialchars($rangee["idUsager"]) . "</p></div>";
            }
        else
        echo "<span>il n'y a pas de résultat à votre recherche</span>";
        }


    function genereArticles($usager)
    {
        global $connexion;
        $requete = "SELECT * FROM article ORDER BY article.ID DESC ";
        $resultat = mysqli_query($connexion, $requete);

        while ($rangee = mysqli_fetch_assoc($resultat))
        {
            echo "<div class='titre2'><div class='flex'><h2>" . htmlspecialchars($rangee["titre"]) . "</h2>";
            if($rangee["idUsager"] == $usager)
            {
                echo "<div class='titre'>
                    <div class='modif'>
                        <form action='modifierArticle.php' method='POST'>
                            <h3>
                                <input type='hidden' name='titre' value='" . htmlspecialchars($rangee["titre"]) . "'>
                                <input type='submit' name='modifier' value='Modifier'>
                            </h3>
                        </form>
                        <form action='supprimer.php' method='POST'>
                            <h3><input type='hidden' name='titre' value='" . htmlspecialchars($rangee["titre"]) . "'><input type='submit' name='supprimer' value='supprimer'>
                            </h3>
                        </form>
                        </div>
                    </div>
                    </div>";
            }
            echo "<p>" . htmlspecialchars($rangee["texte"]) . "</p>
            <p>" . htmlspecialchars($rangee["idUsager"]) . "</p></div>";
        }
    }

    function ajoutArticle($titre, $texte, $idUsager)
    {
        global $connexion;

        $requete = "INSERT INTO article (titre, texte, idUsager) VALUES (?, ?, ?)";
        // exécution de la requête
        $reqPrep = mysqli_prepare($connexion, $requete);
        mysqli_stmt_bind_param($reqPrep, 'sss', $titre, $texte, $idUsager);
        mysqli_stmt_execute($reqPrep);
        mysqli_stmt_get_result($reqPrep);

        $nombreAffecte = mysqli_affected_rows($connexion);
        if ($nombreAffecte > 0)
            return true;
        else
            return false;
    }

    function supprimerArticle($titre)
    {
        global $connexion;

        $requete = "DELETE FROM article WHERE titre = $titre";

        //3. appel de mysqli_query qui retourne true ou false dans le cas de l'insertion
        $resultat = mysqli_query($connexion, $requete);

        if($resultat)
        {
            if(mysqli_affected_rows($connexion) > 0)
                header("Location: articles.php?message=Suppression réussie");
            else
                header("Location: articles.php");
        }
        else
        {
            header("Location: articles.php?message=La suppression n'a pas fonctionné.");            
        }
    }

    function modifierArticle($titre, $texte, $idUsager)
    {
        global $connexion;

        $requete = "UPDATE article SET titre=?, texte=? WHERE id=$idUsager";

    }
    
    
    ?>