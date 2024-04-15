<?php
// Démarrage de la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos</title>
    <link rel="icon" href="./img/circle-info-solid.svg">
    <link rel="stylesheet" href="./../../public/css/default.css">
    <link rel="stylesheet" href="./../../public/css/about-us.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusion de la barre latérale -->
    <?php
    include("./../includes/sidebar.php");
    ?>

    <main>
        <div class="about-us-container">
            <!-- Section sur le projet -->
            <h3>À propos du projet</h3>
            <p>Le projet consiste à développer un système de surveillance environnementale pour la salle de serveurs de l'entreprise Nomios,
                afin de garantir des conditions optimales de fonctionnement pour l'équipement informatique.</p>

            <!-- Section sur les membres -->
            <h3 class="about-us-members">Membres de l'équipe</h3>
            <p>- BOUTABA Ianice</p>
            <p>- KONIECZKOWICZ Raphaël</p>
            <p>- WAUQUIER Alexandre</p>
        </div>
    </main>
</body>
</html>
