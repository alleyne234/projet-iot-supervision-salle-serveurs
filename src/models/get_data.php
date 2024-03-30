<?php

include("./../../config/db.php");

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name, $db_port);

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$sql = "SELECT id, temperature, humidite, horodatage FROM DHT11 ORDER BY id DESC LIMIT 60";
$result = mysqli_query($conn, $sql);
$data = array();

if (mysqli_num_rows($result) > 0) {
    // Récupérer les données de chacune des lignes.
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
} else {
    echo "Aucun résultat.";
}

header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($conn);

?>
