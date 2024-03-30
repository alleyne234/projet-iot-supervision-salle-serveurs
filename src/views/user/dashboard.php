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
<!-- Sidebar Toggle -->
<input type="checkbox" id="sidebar-toggle">
    <label for="sidebar-toggle">
        <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
        <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
    </label>
    
    <!-- Sidebar -->
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
        <div class="dashboard-container">
            <h1>Valeurs DHT11</h1>
            
            <div class="graph-container">
                <!-- Temperature Charts -->
                <div class="temperature-container">
                    <div class="graph temperature-graph">
                        <canvas id="dashboard-temperature-graph"></canvas>
                    </div>
    
                    <div class="graph temperature-graph">
                        <canvas id="dashboard-temperature-gauge"></canvas>
                    </div>
                </div>
    
                <!-- Humidity Charts -->
                <div class="humidity-container">
                    <div class="graph humidity-graph">
                        <canvas id="dashboard-humidity-graph"></canvas>
                    </div>
    
                    <div class="graph humidity-graph">
                        <canvas id="dashboard-humidity-gauge"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="./../../../public/js/charts/temperature-graph.js"></script>
    <script type="module" src="./../../../public/js/charts/temperature-gauge.js"></script>
    <script type="module" src="./../../../public/js/charts/humidity-graph.js"></script>
    <script type="module" src="./../../../public/js/charts/humidity-gauge.js"></script>
</body>
</html>
