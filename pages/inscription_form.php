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
        <p>Vous avez déjà un compte ? <a href="#" onclick="loadForm('connexion')">Se connecter</a></p>
    </div>
</div>
