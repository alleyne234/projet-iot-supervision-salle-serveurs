<?php

include("./../config/db.php");

$message = '';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Connexion</h2>

        <?php if (!empty($message)): ?>
            <p style="color:red"><?= $message ?></p>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div>
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username">
            </div>

            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <input type="submit" value="Se connecter">
            </div>
        </form>
    </div>
</body>
</html>