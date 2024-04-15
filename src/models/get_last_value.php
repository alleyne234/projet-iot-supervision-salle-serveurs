<?php
// Inclusion du fichier de configuration de la base de données
include("./../../config/db.php");

// Requête SQL pour récupérer la dernière valeur de température et d'humidité
$sql = "SELECT id, temperature, humidite, horodatage FROM dht11 ORDER BY id DESC LIMIT 1";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// Vérification s'il y a des données retournées par la requête
if ($stmt->rowCount() === 0) {
    echo '<script>console.error("Aucune donnée n\'a été trouvée.")</script>';
    exit();
}

// Récupération des données
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Définition et encodage des données au format JSON avant envoi de la réponse
header('Content-Type: application/json');
echo json_encode($data);
?>
