<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ./../../../public/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Utilisateur</title>
    <link rel="icon" href="./../../../public/img/gauge-solid.svg">
    <link rel="stylesheet" href="./../../../public/css/default.css">
    <link rel="stylesheet" href="./../../../public/css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
<input type="checkbox" id="sidebar-toggle">
    <label for="sidebar-toggle">
        <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
        <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
    </label>
    
    <div class="sidebar">
        <a href="./../../../index.php" class="active">
            <i class="fa-solid fa-house"></i>
            <span>Accueil</span>
        </a>
        <a href="./../../../public/logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
            <span>Déconnexion</span>
        </a>
    </div>

    <main>
    </main>
</body>
</html>
