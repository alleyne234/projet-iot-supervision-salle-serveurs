<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ./../../../public/login.php');
    exit;
}

include("./../../../config/db.php");

$message = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $is_admin = isset($_POST['is-admin']) ? 1 : 0;

    $sql = "INSERT INTO users (email, username, password, is_admin) VALUES (:email, :username, :password, :is_admin)";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute(['email' => $email, 'username' => $username, 'password' => $password, 'is_admin' => $is_admin]);

    if ($result) {
        $message = '<p style="color:green">Inscription réussie !</p>';
    } else {
        $message = '<p style="color:red">Erreur lors de l\'inscription.</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau utilisateur</title>
    <link rel="icon" href="./../../../public/img/id-card-regular.svg">
    <link rel="stylesheet" href="./../../../public/css/default.css">
    <link rel="stylesheet" href="../../../public/css/register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Back Button -->
    <a href="./dashboard.php" id="back-button">
        <i class="fa-solid fa-backward-step" id="sidebar-btn-open"></i>
    </a>

    <main>
        <div class="register-container">
            <h2>Information utilisateur</h2>
    
            <?php if (!empty($message)): ?>
                <?= $message ?>
            <?php endif; ?>
    
            <form action="register.php" method="post">
                <div>
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" placeholder="email" required>
                </div>
                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" placeholder="username">
                </div>
    
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="password">
                </div>
    
                <div>
                    <label for="is-admin">Administrateur :</label>
                    <input type="checkbox" id="is-admin" name="is-admin">
                </div>
    
                <div>
                    <input type="submit" value="Créer">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
