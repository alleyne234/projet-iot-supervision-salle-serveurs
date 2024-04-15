<?php
// Configuration de la base de données
$db_host = 'localhost';
$db_port = '3306';
$db_name   = 'db1';
$db_charset = 'utf8mb4';
$db_username = 'root';
$db_password = '';

// Chaîne de connexion PDO
$dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=$db_charset";

try {
    // Connexion à la base de données
    $dbh = new PDO($dsn, $db_username, $db_password);

    // Configuration pour générer des exceptions en cas d'erreur
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<script>console.error("Échec de la connexion avec la base de données : ' . $e->getMessage() . '")</script>';
}
?>
