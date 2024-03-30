<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="icon" href="./public/img/house-solid.svg">
    <link rel="stylesheet" href="./public/css/default.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <input type="checkbox" id="sidebar-toggle">
    <label for="sidebar-toggle">
        <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
        <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
    </label>
    
    <div class="sidebar">
        <a href="./index.php" class="active">
            <i class="fa-solid fa-house"></i>
            <span>Accueil</span>
        </a>
        <a href="./public/login.php">
            <i class="fa-solid fa-key"></i>
            <span>Connexion</span>
        </a>
        <a href="./public/about-us.php">
            <i class="fa-solid fa-circle-info"></i>
            <span>À Propos</span>
        </a>
    </div>
</body>
</html>
