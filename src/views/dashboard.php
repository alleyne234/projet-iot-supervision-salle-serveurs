<?php
// Démarrage de la session
session_start();

// Vérification de la connexion de l'utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - <?php echo $_SESSION['user_is_admin'] ? 'Administrateur' : 'Utilisateur'; ?></title>
    <link rel="icon" href="./../../public/img/gauge-solid.svg">
    <link rel="stylesheet" href="./../../public/css/default.css">
    <link rel="stylesheet" href="./../../public/css/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusion de la barre latérale -->
    <?php
    include("./../includes/sidebar.php");
    ?>

    <main>
        <div class="dashboard-container">
            <!-- Notifications -->
            <div id="notifications">
                <div id="temperature-warning" class="alert warning hide-notification">
                    <span class="alert-text"></span>
                </div>

                <div id="humidity-warning" class="alert warning hide-notification">
                    <span class="alert-text"></span>
                </div>
            </div>

            <h1>Valeurs DHT11</h1>
            
            <div class="graph-container">
                <!-- Graphique de température -->
                <div class="temperature-container">
                    <div class="graph temperature-graph">
                        <canvas id="dashboard-temperature-graph"></canvas>
                    </div>
    
                    <div class="graph temperature-graph current-value">
                        <h3>Température actuelle</h3>
                        <h1 id="dashboard-current-temperature"></h1>
                    </div>
                </div>
    
                <!-- Graphique d'humidité -->
                <div class="humidity-container">
                    <div class="graph humidity-graph">
                        <canvas id="dashboard-humidity-graph"></canvas>
                    </div>
    
                    <div class="graph humidity-graph current-value">
                        <h3>Humidité actuelle</h3>
                        <h1 id="dashboard-current-humidity"></h1>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="./../../public/js/charts/temperature-graph.js"></script>
    <script type="module" src="./../../public/js/charts/humidity-graph.js"></script>
    <script src="./../../public/js/update-current-values.js"></script>
</body>
</html>
