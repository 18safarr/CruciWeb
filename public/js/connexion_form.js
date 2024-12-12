document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("#login-form");

    if (loginForm) { // Vérifie si le formulaire existe
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            const formData = new FormData(loginForm);

            fetch("../app/auth.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        loadDashboardContent();
                    } else {
                        const errorMessage = document.querySelector(".error-message");
                        if (errorMessage) {
                            errorMessage.style.display = "block";
                        }
                        console.log("Échec de la connexion");
                    }
                })
                .catch((error) => {
                    console.error("Erreur lors de l'authentification :", error);
                });
        });
    }

    function loadDashboardContent() {
        fetch("../pages/dashboard.php")
            .then((response) => response.text())
            .then((html) => {
                const rightContainer = document.querySelector(".right-container");
                if (rightContainer) {
                    rightContainer.innerHTML = html;
                }
            })
            .catch((error) => {
                console.error("Erreur lors du chargement du tableau de bord :", error);
            });
    }
});
