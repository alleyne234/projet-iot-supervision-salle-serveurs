<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="icon" href="./public/img/house-solid.svg">
    <link rel="stylesheet" href="./public/css/default.css">
    <link rel="stylesheet" href="./public/css/home.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Supervision salle serveurs</h1>
        <h3>Nomios</h3>
    </header>

    <!-- Sidebar -->
    <?php
    include("./src/includes/sidebar.php");
    ?>
</body>
</html>
