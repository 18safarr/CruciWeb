<?php
session_start(); // Assurez-vous que les sessions sont activées pour vérifier l'authentification.

if (isset($_SESSION['user_id'])) { // Vérifiez si l'utilisateur est connecté.
    echo '
    <div class="user-dashboard">
        <div class="profile">
            <img src="images/user.png" alt="Photo de profil" class="profile-pic">
            <h2>Bienvenue</h2>
        </div>
        <div class="actions">
            <button class="btn blue-btn" class="inactive" id="voir-grilles-public">Home</button>
            <button class="btn blue-btn" id="voir-mes-grilles">Mes grilles</button>
            <button class="btn blue-btn">Mes parties</button>
            <button class="btn blue-btn">Ajouter grille</button>
        </div>
        <button class="btn red-btn">Déconnexion</button>
    </div>';
} else {
    echo '<p>Vous devez être connecté pour accéder à ce contenu.</p>';
}
?>
