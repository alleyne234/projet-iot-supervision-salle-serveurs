<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ./../../../public/login.php');
    exit;
}

require_once("./../../../config/db.php");

$message = '';

function validate_username($username) {
    return preg_match('/^[a-zA-Z][a-zA-Z0-9_.-]{3,29}$/', $username);
}

function validate_password($password) {
    return preg_match('/^[a-zA-Z0-9!"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]{4,70}$/', $password);
}

// Vérification que la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérification de la présence des identifiants
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $is_admin = isset($_POST['is-admin']) ? 1 : 0;

        // Vérification des exigences pour les identifiants
        if (!validate_username($username)) {
            $message = '<p style="color:red">Le nom d\'utilisateur doit répondre aux exigences suivantes :<br>
            - Avoir entre 4 et 30 caractères<br>
            - Peut contenir des lettres, des chiffres<br>
            - Peut contenir les caractères "_", "." ou "-"
            </p>';
        } elseif (!validate_password($password)) {
            $message = '<p style="color:red">Le mot de passe doit répondre aux exigences suivantes :<br>
            - Avoir entre 4 et 70 caractères<br>
            - Peut contenir des lettres et des chiffres<br>
            - Peut contenir les caractères spéciaux suivants :<br>
            !"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~
            </p>';
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Requête SQL
            $sql = "INSERT INTO users (email, username, password, is_admin) VALUES (:email, :username, :password, :is_admin)";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute(['email' => $email, 'username' => $username, 'password' => $password_hash, 'is_admin' => $is_admin]);

            if ($result) {
                $message = "<p style='color:green'>Inscription réussie</p>";
            } else {
                $message = "<p style='color:red'>Erreur lors de l'inscription</p>";
            }
        }
    } else {
        $message = "<p style='color:red'>Veuillez saisir une adresse email, un nom d'utilisateur et un mot de passe.</p>";
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
    <!-- Sidebar -->
    <?php
    include("./../../includes/sidebar.php");
    ?>

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
