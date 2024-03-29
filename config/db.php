<?php

$db_host = 'localhost';
$db_port = '3306';
$db_name   = 'db1';
$db_charset = 'utf8mb4';
$db_username = 'root';
$db_password = '';

$dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=$db_charset";

try {
     $pdo = new PDO($dsn, $db_username, $db_password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
     echo "Échec de la connexion : " . $e->getMessage();
}

?>
