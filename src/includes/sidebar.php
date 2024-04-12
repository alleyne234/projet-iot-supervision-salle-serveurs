<?php
$root_folder_name = 'projet-iot-supervision-salle-serveurs/';
$page_name = basename($_SERVER['PHP_SELF']);
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let sidebarState = localStorage.getItem("sidebar-toggle");
    
    if (sidebarState !== null) {
        document.getElementById("sidebar-toggle").checked = sidebarState === "true";
    }
});

function saveState() {
    let checkbox = document.getElementById("sidebar-toggle");
    localStorage.setItem("sidebar-toggle", checkbox.checked.toString());
}
</script>

<!-- Sidebar Toggle -->
<input type="checkbox" id="sidebar-toggle" onClick="saveState()">
<label for="sidebar-toggle">
    <i class="fa-solid fa-bars" id="sidebar-btn-open"></i>
    <i class="fa-solid fa-xmark" id="sidebar-btn-close"></i>
</label>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Username -->
    <?php if (isset($_SESSION['user_name'])): ?>
        <h2><?php echo $_SESSION['user_name'] ?></h2>
    <?php endif; ?>

    <div class="sidebar-links">
        <!-- Home -->
        <a href="/<?php echo $root_folder_name ?>index.php"
        <?php if ($page_name == "index.php") echo 'class="active-page"'; ?>>
            <i class="fa-solid fa-house"></i>
            <span>Accueil</span>
        </a>

        <!-- Register -->
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_is_admin']): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/register.php"
            <?php if ($page_name == "register.php") echo 'class="active-page"'; ?>>
            <i class="fa-regular fa-id-card"></i>
                <span>Créer compte</span>
            </a>
        <?php endif; ?>

        <!-- Dashboard -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/dashboard.php"
            <?php if ($page_name == "dashboard.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-circle-info"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>

        <!-- Login -->
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/login.php"
            <?php if ($page_name == "login.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-key"></i>
                <span>Connexion</span>
            </a>
        <?php endif; ?>

        <!-- Logout -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/<?php echo $root_folder_name ?>src/views/logout.php"
            <?php if ($page_name == "logout.php") echo 'class="active-page"'; ?>>
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Déconnexion</span>
            </a>
        <?php endif; ?>

        <!-- About us -->
        <a href="/<?php echo $root_folder_name ?>src/views/about-us.php"
        <?php if ($page_name == "about-us.php") echo 'class="active-page"'; ?>>
            <i class="fa-solid fa-circle-info"></i>
            <span>À Propos</span>
        </a>
    </div>
</div>
