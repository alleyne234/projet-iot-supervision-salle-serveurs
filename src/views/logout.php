<?php
// Démarrage de la session
session_start();

// Suppression de toutes les variables de session
$_SESSION = array();

// Suppression des cookies de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruction de la session
session_destroy();

// Redirection vers la page de connexion
header('Location: ./login.php');
exit;
?>
