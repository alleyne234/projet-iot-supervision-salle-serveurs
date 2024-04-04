<?php
include("./../../config/db.php");

$sql = "SELECT id, temperature, humidite, horodatage FROM dht11 ORDER BY id DESC LIMIT 1";
$stmt = $dbh->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    echo '<script>console.error("Aucune donnée n\'a été trouvée.")</script>';
    exit();
}

$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
?>
