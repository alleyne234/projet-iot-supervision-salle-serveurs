<?php
session_start();

// Inclusion du fichier de configuration de la base de données
require_once('./../config/db.php');

// Message d'erreur par défaut
$error_message = '';

// Vérification que la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification de la présence des identifiants
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);

        // Requête SQL
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();
        
        // Vérification de l'existence de l'utilisateur et de la correspondance du mot de passe
        if ($user && password_verify($_POST['password'], $user['password'])) {
            // Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_is_admin'] = $user['is_admin'];

            if ($user['is_admin']) {
                // Redirection vers le tableau de bord de l'administrateur
                header('Location: ./../src/views/admin/dashboard.php');
                exit();
            } else {
                // Redirection vers le tableau de bord de l'utilisateur
                header('Location: ./../src/views/user/dashboard.php');
                exit();
            }
        } else {
            $error_message = "Mauvais identifiants";
        }
    } else {
        $error_message = "Veuillez saisir un nom d\'utilisateur et un mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="icon" href="./../public/img/key-solid.svg">
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <?php
    include("./../src/includes/sidebar.php");
    ?>

    <main>
                <div class="login-container">
            <h2>Connexion</h2>

            <form action="login.php" method="post">
                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" placeholder="username">
                </div>
                
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="password">
                </div>
                
                <div>
                    <input type="submit" value="Se connecter">
                </div>

                <?php if (!empty($error_message)): ?>
                    <p style="color:red"><?= $error_message ?></p>
                <?php endif; ?>
            </form>
        </div>
    </main>
</body>
</html>
