<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos</title>
    <link rel="icon" href="./img/circle-info-solid.svg">
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/about-us.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?php
    include("./../src/includes/sidebar.php");
    ?>

    <main>
        <div class="about-us-container">
            <!-- About the project -->
            <h3>À propos du projet</h3>
            <p>Le projet consiste à développer un système de surveillance environnementale pour la salle de serveurs de l'entreprise Nomios,
                afin de garantir des conditions optimales de fonctionnement pour l'équipement informatique.</p>

            <!-- Members -->
            <h3 class="about-us-members">Membres de l'équipe</h3>
            <p>- BOUTABA Ianice</p>
            <p>- KONIECZKOWICZ Raphael</p>
            <p>- WAUQUIER Alexandre</p>
        </div>
    </main>
</body>
</html>
