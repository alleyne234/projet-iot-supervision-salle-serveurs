<?php
include("./../config/db.php");

$message = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];

        // Vérifier si l'utilisateur est un administrateur.
        if ($user['is_admin']) {
            header('Location: ./../src/views/admin/dashboard.php');
        } else {
            header('Location: ./../src/views/user/dashboard.php');
        }
    } else {
        $message = 'Mauvais identifiants';
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
        <input type="checkbox" id="sidebar-toggle">
    <label for="sidebar-toggle">
        <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
        <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
    </label>
    
        <div class="sidebar">
        <a href="./../index.php" class="active">
            <i class="fa-solid fa-house"></i>
            <span>Accueil</span>
        </a>
        <a href="./../public/about-us.php">
            <i class="fa-solid fa-circle-info"></i>
            <span>À Propos</span>
        </a>
    </div>

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

                <?php if (!empty($message)): ?>
                    <p style="color:red"><?= $message ?></p>
                <?php endif; ?>
            </form>
        </div>
    </main>
</body>
</html>
