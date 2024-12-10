document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("#login-form");

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Empêche le rechargement de la page.

        const formData = new FormData(loginForm);

        fetch("../app/auth.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Charger dynamiquement le contenu du tableau de bord.
                    loadDashboardContent();
                } else {
                    document.querySelector(".error-message").style.display = "block";
                    console.log("Echec connexion");
                }
            })
            .catch((error) => {
                console.error("Erreur lors de l'authentification :", error);
            });
    });

    function loadDashboardContent() {
        fetch("../pages/dashboard.php")
            .then((response) => response.text())
            .then((html) => {
                const rightContainer = document.querySelector(".right-container");
                rightContainer.innerHTML = html;
            })
            .catch((error) => {
                console.error("Erreur lors du chargement du tableau de bord :", error);
            });
    }
});
