<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <style>
        .buttons-container {
            text-align: center;
            margin-top: 50px;
        }
        .btn {
            margin: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="buttons-container">
        <a href="./public/login.php" class="btn">Se Connecter</a>
        <a href="./public/register.php" class="btn">S'inscrire</a>
        <a href="./src/views/user/dashboard.php" class="btn">Dashboard</a>
    </div>
</body>
</html>
