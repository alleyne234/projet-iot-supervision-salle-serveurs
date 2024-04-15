<?php
// Définition du nom du dossier racine du projet
$root_folder_name = 'projet-iot-supervision-salle-serveurs/';

// Récupération du nom de la page actuelle
$page_name = basename($_SERVER['PHP_SELF']);
?>

<script>
    // Script pour la gestion de l'état de la barre latérale dans le stockage local du navigateur
    document.addEventListener("DOMContentLoaded", function() {
        let sidebarState = localStorage.getItem("sidebar-toggle");
        
        if (sidebarState !== null) {
            document.getElementById("sidebar-toggle").checked = sidebarState === "true";
        }
    });

    // Fonction pour sauvegarder l'état de la barre latérale dans le stockage local
    function saveState() {
        let checkbox = document.getElementById("sidebar-toggle");
        localStorage.setItem("sidebar-toggle", checkbox.checked.toString());
    }
</script>

<!-- Bouton pour afficher/masquer la barre latérale -->
<input type="checkbox" id="sidebar-toggle" onClick="saveState()">
<label for="sidebar-toggle">
    <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
    <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
</label>

<!-- Barre latérale -->
<div class="sidebar">
    <!-- Affichage du nom de l'utilisateur dans la barre latérale s'il est connecté -->
    <?php if (isset($_SESSION['user_name'])): ?>
        <h2><?php echo $_SESSION['user_name'] ?></h2>
    <?php endif; ?>

    <div class="sidebar-links">
        <!-- Lien vers la page d'accueil -->
        <a href="/<?php echo $root_folder_name ?>index.php"
        <?php if ($page_name == "index.php") echo 'class="active-page"'; ?>>
            <i class="fa-solid fa-house"></i>
            <span>Accueil</span>
        </a>

        <!-- Lien vers la page de création de compte (accessible uniquement pour les administrateurs) -->
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_is_admin']): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/register.php"
            <?php if ($page_name == "register.php") echo 'class="active-page"'; ?>>
            <i class="fa-regular fa-id-card"></i>
                <span>Créer compte</span>
            </a>
        <?php endif; ?>

        <!-- Lien vers le tableau de bord (si l'utilisateur est connecté) -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/dashboard.php"
            <?php if ($page_name == "dashboard.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-circle-info"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>

        <!-- Lien vers la page de connexion (si l'utilisateur n'est pas connecté) -->
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/login.php"
            <?php if ($page_name == "login.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-key"></i>
                <span>Connexion</span>
            </a>
        <?php endif; ?>

        <!-- Lien pour se déconnecter (si l'utilisateur est connecté) -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/logout.php"
            <?php if ($page_name == "logout.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Déconnexion</span>
            </a>
        <?php endif; ?>

        <!-- Lien vers la page À Propos -->
        <a href="/<?php echo $root_folder_name ?>src/views/about-us.php"
        <?php if ($page_name == "about-us.php") echo 'class="active-page"'; ?>>
            <i class="fa-solid fa-circle-info"></i>
            <span>À Propos</span>
        </a>
    </div>
</div>
