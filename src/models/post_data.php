<?php
include("./../../config/db.php");

$temperature = $_GET['temperature'];
$humidity = $_GET['humidite'];

// Validation des données
if (is_numeric($temperature) && is_numeric($humidity)) {
    // Vérification des plages raisonnables
    if ($temperature >= 0 && $temperature <= 50 && $humidity >= 20 && $humidity <= 80) {
        try {
            $sql = "INSERT INTO dht11 (temperature, humidite) VALUES (:temperature, :humidite)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':temperature', $temperature);
            $stmt->bindParam(':humidite', $humidity);
            $stmt->execute();
        } catch (PDOException $e) {
            echo '<script>console.error("Erreur lors de l\'envoi des données : ' . $e->getMessage() . '")</script>';
        }
    } else {
        echo '<script>console.error("Les valeurs de température et d\'humidité ne sont pas dans les plages raisonnables.")</script>';
    }
} else {
    echo '<script>console.error("Les valeurs de température et d\'humidité doivent être des nombres.")</script>';
}
?>
