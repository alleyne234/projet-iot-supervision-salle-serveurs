<?php
// Inclusion du fichier de configuration de la base de données
include("./../../config/db.php");

// Requête SQL pour sélectionner les dernières 60 lignes de données de la table dht11
$sql = "SELECT id, temperature, humidite, horodatage FROM dht11 ORDER BY id DESC LIMIT 60";
$stmt = $dbh->prepare($sql);
$stmt->execute();

// Vérification si aucune donnée n'a été trouvée
if ($stmt->rowCount() === 0) {
    echo '<script>console.error("Aucune donnée n\'a été trouvée.")</script>';
    exit();
}

// Initialisation d'un tableau pour stocker les données
$data = array();

// Boucle pour récupérer chaque ligne de données
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($data, $row);
}

// Définition et encodage des données au format JSON avant envoi de la réponse
header('Content-Type: application/json');
echo json_encode($data);
?>
