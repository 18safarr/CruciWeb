<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/inscription.css">

    <script src="js/inscription.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CrusiWeb">
        </div>
        <nav>
            <button class="active">Connexion</button>
            <button class="inactive">S'inscrire</button>
        </nav>
    </header>
    <div class="container">
    
        <main>
                <div class="form-container">
                    <div class="logo">
                        <img src="images/sign_in.png" alt="Logo Crucigrille">
                    </div>
                    <h1>Créer un compte</h1>
                    <form id="inscription-form">
                        <div class="form-group">
                            <label for="email">Adresse e-mail</label>
                            <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmer le mot de passe</label>
                            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" required>
                        </div>
                        <div id="error-message" class="error hidden">
                            <p>Les mots de passe ne correspondent pas.</p>
                        </div>
                        <button type="submit" class="btn">S'inscrire</button>
                    </form>
                    <div class="footer">
                        <p>Vous avez déjà un compte ? <a href="?p=auth">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </main>


        <footer>
            <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CruciWeb. Tous droits réservés.</p>
        </footer>
    </div>

</body>
</html>



