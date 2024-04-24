<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de configuration de la base de données
require_once('./../../config/db.php');

// Message d'erreur par défaut
$error_message = '';

$username = '';

// Vérification que la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);

    // Vérification de la présence des identifiants
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        // Requête SQL pour récupérer l'utilisateur correspondant au nom d'utilisateur saisi
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

            // Redirection vers le tableau de bord
            header('Location: ./dashboard.php');
            exit();
        } else {
            $error_message = "Mauvais identifiants";
        }
    } else {
        $error_message = "Veuillez saisir un nom d'utilisateur et un mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="icon" href="./../../public/img/key-solid.svg">
    <link rel="stylesheet" href="./../../public/css/default.css">
    <link rel="stylesheet" href="./../../public/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusion de la barre latérale -->
    <?php
    include("./../includes/sidebar.php");
    ?>

    <main>
        <div class="login-container">
            <h2>Connexion</h2>

            <!-- Formulaire de connexion -->
            <form action="login.php" method="post">
                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" value="<?php echo $username ?>" placeholder="username">
                </div>
                
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" placeholder="password">
                </div>
                
                <div>
                    <input type="submit" value="Se connecter">
                </div>

                <!-- Affichage du message d'erreur -->
                <?php if (!empty($error_message)): ?>
                    <p style="color:red"><?= $error_message ?></p>
                <?php endif; ?>
            </form>
        </div>
    </main>
</body>
</html>
