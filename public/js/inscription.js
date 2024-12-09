document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("inscription-form");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const errorMessage = document.getElementById("error-message");

    // Validation des mots de passe avant l'envoi du formulaire
    form.addEventListener("submit", (event) => {
        // Vérifie si les mots de passe correspondent
        if (passwordInput.value !== confirmPasswordInput.value) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            errorMessage.classList.remove("hidden"); // Affiche le message d'erreur
        } else {
            errorMessage.classList.add("hidden"); // Cache le message d'erreur
        }
    });

    // Masquer le message d'erreur lorsque l'utilisateur modifie les champs
    confirmPasswordInput.addEventListener("input", () => {
        if (errorMessage.classList.contains("hidden")) return;
        if (passwordInput.value === confirmPasswordInput.value) {
            errorMessage.classList.add("hidden");
        }
    });
});
