<?php
include("./../../config/db.php");

$temperature = $_GET['temperature'];
$humidity = $_GET['humidite'];

try {
    $sql = "INSERT INTO dht11 (temperature, humidite) VALUES (:temperature, :humidite)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':temperature', $temperature);
    $stmt->bindParam(':humidite', $humidity);
    $stmt->execute();
} catch (PDOException $e) {
    echo '<script>console.error("Erreur lors de l\'envoi des données : ' . $e->getMessage() . '")</script>';
}
?>
