<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/authentification.css">

    <script src="js/authentification.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="images/logo.png" alt="Logo CrusiWeb">
            </div>
            <nav>
                <button class="inactive">Connexion</button>
                <button class="active">S'inscrire</button>
            </nav>
        </header>

        <main>
            <div class="login-box">
                <img src="images/auth.png" alt="User Icon" class="user-icon">
                <form id="login-form">
                    <div class="input-container">
                       
                          
                            <input type="text" id="username" placeholder="Identifiant ou e-mail" required>
                       
                    </div>
                    <div class="input-container">
                      
                           
                            <input type="password" id="password" placeholder="Mot de passe" required>
                      
                    </div>
                    <p class="error-message" style="display:none;">message identifiant ou mot de incorrecte</p>
                    <button type="submit" class="login-button">Se connecter</button>
                </form>
                <div class="footer">
                        <p>Vous n'avez pas de compte ? <a href="?p=ins">S'inscrire</a></p>
                </div>
            </div>
        </main>

        <footer>
            <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CruciWeb. Tous droits réservés.</p>
        </footer>
    </div>

</body>
</html>
