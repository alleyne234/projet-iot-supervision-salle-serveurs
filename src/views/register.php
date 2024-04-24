<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté et s'il est administrateur
if (!isset($_SESSION['user_id']) || !$_SESSION['user_is_admin']) {
    header('Location: ./../../index.php');
    exit;
}

// Inclusion du fichier de configuration de la base de données
require_once("./../../config/db.php");

// Message d'information
$message = '';


// Fonction de validation du nom d'utilisateur
function validate_username($username) {
    return preg_match('/^[a-zA-Z][a-zA-Z0-9_.-]{3,29}$/', $username);
}


// Fonction de validation du mot de passe
function validate_password($password) {
    return preg_match('/^[a-zA-Z0-9!"#$%&\'()*+,-.\/:;<=>?@[\\]^_`{|}~]{4,70}$/', $password);
}

$email = '';
$username = '';

// Vérification que la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Vérification de la présence des identifiants
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
        $is_admin = isset($_POST['is-admin']) ? 1 : 0;

        // Requête SQL pour la vérification de la présence d'un nom d'utilisateur identique
        $sql_check_username_exists = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt_check_username_exists = $dbh->prepare($sql_check_username_exists);
        $stmt_check_username_exists->execute(['username' => $username]);
        $username_count = $stmt_check_username_exists->fetchColumn();

        // Vérification de la présence d'un nom d'utilisateur identique et des exigences pour les identifiants
        if ($username_count > 0) {
            $message = '<p style="color:red">Ce nom d\'utilisateur est déjà utilisé. Veuillez choisir un autre nom d\'utilisateur.</p>';

            // Validation du nom d'utilisateur
        } elseif (!validate_username($username)) {
            $message = '<p style="color:red">Le nom d\'utilisateur doit répondre aux exigences suivantes :<br>
            - Avoir entre 4 et 30 caractères<br>
            - Peut contenir des lettres, des chiffres<br>
            - Peut contenir les caractères "_", "." ou "-"
            </p>';

            // Validation du mot de passe
        } elseif (!validate_password($password)) {
            $message = '<p style="color:red">Le mot de passe doit répondre aux exigences suivantes :<br>
            - Avoir entre 4 et 70 caractères<br>
            - Peut contenir des lettres et des chiffres<br>
            - Peut contenir les caractères spéciaux suivants :<br>
            !"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~
            </p>';

            // Hashage du mot de passe
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Requête SQL
            $sql = "INSERT INTO users (email, username, password, is_admin) VALUES (:email, :username, :password, :is_admin)";
            $stmt = $dbh->prepare($sql);
            $result = $stmt->execute(['email' => $email, 'username' => $username, 'password' => $password_hash, 'is_admin' => $is_admin]);
            
            // Vérification du résultat de la requête
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
    <link rel="icon" href="./../../public/img/id-card-regular.svg">
    <link rel="stylesheet" href="./../../public/css/default.css">
    <link rel="stylesheet" href="./../../public/css/register.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Inclusion de la barre latérale -->
    <?php
    include("./../includes/sidebar.php");
    ?>

    <main>
        <div class="register-container">
            <h2>Information utilisateur</h2>

            <!-- Affichage du message d'information -->
            <?php if (!empty($message)): ?>
                <?= $message ?>
            <?php endif; ?>
            
            <!-- Formulaire d'inscription -->
            <form action="register.php" method="post">
                <div>
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" value="<?php echo $email ?>" placeholder="email" required>
                </div>
                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" value="<?php echo $username ?>" placeholder="username">
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
