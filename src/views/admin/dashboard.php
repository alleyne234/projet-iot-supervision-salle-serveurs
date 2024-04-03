<?php
session_start();

// Vérifier si l'utilisateur est connecté et si il est administrateur
if (!isset($_SESSION['user_id']) || !$_SESSION['user_is_admin']) {
    header('Location: ./../../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Administrateur</title>
    <link rel="icon" href="./../../../public/img/gauge-solid.svg">
    <link rel="stylesheet" href="./../../../public/css/default.css">
    <link rel="stylesheet" href="./../../../public/css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?php
    include("./../../includes/sidebar.php");
    ?>

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
