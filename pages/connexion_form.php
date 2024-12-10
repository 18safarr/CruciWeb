<div class="form-container">
    <div class="logo">
        <img src="images/auth.png" alt="Logo Crucigrille">
    </div>
    <h1>Se connecter</h1>
    <form id="login-form" method="post">
        <div class="form-group">
            <label for="username">Identifiant ou e-mail</label>
            <input type="text" id="username" name="username" placeholder="Entrez votre identifiant" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>
        <p class="error-message" style="display:none;">Identifiant ou mot de passe incorrect</p>
        <button type="submit" class="btn">Se connecter</button>
    </form>
    <div class="footer">
        <p>Vous n'avez pas de compte ? <a href="#" onclick="loadForm('inscription')">S'inscrire</a></p>
    </div>
</div>
