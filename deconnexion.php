<?php
// ouverture de la session
        session_start();

// Destruction des variables de session
$_SESSION = array();

// Destruction des cookies de la session
    if (ini_get("session.use_cookies")) 
    {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Destruction de la session
    session_destroy();

// Retour à la page articles
    header("Location: articles.php");
?>
