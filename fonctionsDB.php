<?php
    function connect()
    {
        // ici on se connecte à la base de données
        $c = mysqli_connect("localhost", "root", "", "login");

        if(!$c)
        {
            die("erreur de connexion : " . mysqli_connect_error());
        }

        return $c;
    }

    $connexion = connect();

    // ici c'est la fonction pour permettre à l'usager de se connecter et de proteger l'usager
    function protection($usager, $motDePasse)
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
    
    
    ?>