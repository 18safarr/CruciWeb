document.addEventListener("DOMContentLoaded", function () {
    const togglePasswordBtn = document.querySelector(".toggle-password");
    const passwordField = document.getElementById("password");
    const form = document.getElementById("login-form");
    const errorMessage = document.querySelector(".error-message");

    // Handle form submission
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        // Example validation
        if (username === "admin" && password === "password") {
            errorMessage.style.display = "none";
            alert("Connexion réussie !");
        } else {
            errorMessage.style.display = "block";
        }
    });
});
