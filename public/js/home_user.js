document.addEventListener("DOMContentLoaded", function () {
    //-----------------------CONNEXION-------------------------

    const loginForm = document.querySelector("#login-form");
    if (loginForm) { // Vérifie si le formulaire existe
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            const formData = new FormData(loginForm);

            fetch("../app/ajax/auth.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = '../public/'
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

//------------------------DASHBOARD----------------------------

    // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-mes-grilles") {

            // Envoyer les données au serveur
            fetch('../app/ajax/load_liste_grille.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `load-liste-grille=privee` // Paramètres envoyés au serveur
            })
            .then(response => response.text()) // Récupération de la réponse sous forme de texte
            .then(html => {
                document.getElementById('grilleTable').innerHTML = html; // Injection de la grille reçue du serveur
            })
            .catch(error => console.error('Erreur lors du chargement des grilles:', error)); // Gestion des erreurs
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-grilles-public") {

            // Envoyer les données au serveur
            fetch('../app/ajax/load_liste_grille.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `load-liste-grille=public` // Paramètres envoyés au serveur
            })
            .then(response => response.text()) // Récupération de la réponse sous forme de texte
            .then(html => {
                document.getElementById('grilleTable').innerHTML = html; // Injection de la grille reçue du serveur
            })
            .catch(error => console.error('Erreur lors du chargement des grilles:', error)); // Gestion des erreurs
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "add-grille") {
        
        
                window.location.href = '../public?p=ajouter_grille'; // Redirigez vers une page spécifique
        
            
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "logout") {
        
            fetch('../app/ajax/logout.php')
            .then(() => {
                window.location.href = '../public'; // Redirigez vers une page spécifique
            })
            .catch(error => console.error('Erreur lors de la déconnexion:', error));
            
        }
    });









});