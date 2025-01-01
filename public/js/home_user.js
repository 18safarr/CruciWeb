document.addEventListener("DOMContentLoaded", function () {
    //-----------------------CONNEXION-------------------------

    const loginForm = document.querySelector("#login-form");
    if (loginForm) { // Vérifie si le formulaire existe
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            const formData = new FormData(loginForm);

            fetch("app/controllers/ajax/login.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        window.location.href = 'index.php'
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


 //------------------INSCRIPTION---------------------------------
    document.addEventListener("click", function (e) {

        if (e.target && e.target.id==="submit-inscription"){
            e.preventDefault(); // Empêche le rechargement de la page

            // Récupération des valeurs des champs
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const confirmPassword = document.getElementById("confirm-password").value.trim();
            const errorMessage = document.getElementById("error-message");

            // Réinitialisation des messages d'erreur
            errorMessage.classList.add("hidden");

            // Validation des mots de passe
            if (password !== confirmPassword) {
                errorMessage.classList.remove("hidden");
                return;
            }

            // Préparation des données à envoyer
            const formData = new FormData();
            formData.append("email", email);
            formData.append("password", password);

            // Envoi des données via fetch (AJAX)
            fetch("app/controllers/ajax/register.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Une erreur s'est produite lors de l'inscription.");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        alert("Inscription réussie ! Bienvenue !");
                        // Redirection ou autres actions
                        window.location.href = "index.php";
                    } else {
                        alert(data.message || "Une erreur s'est produite.");
                    }
                })
                .catch((error) => {
                    console.error("Erreur :", error);
                    alert("Impossible de vous inscrire pour le moment. Veuillez réessayer plus tard.");
                });
            }
    });



 //---------------------------------------------


//------------------------DASHBOARD----------------------------

    // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-mes-grilles") {

            // Envoyer les données au serveur
            fetch('app/controllers/ajax/load_liste_grille.php', {
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

    // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-parties'
        if (e.target && e.target.id === "voir-mes-parties") {

            // Envoyer les données au serveur
            fetch('app/controllers/ajax/load_liste_grille.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `load-liste-grille=partie` // Paramètres envoyés au serveur
            })
            .then(response => response.text()) // Récupération de la réponse sous forme de texte
            .then(html => {
                document.getElementById('grilleTable').innerHTML = html; // Injection de la grille reçue du serveur
            })
            .catch(error => console.error('Erreur lors du chargement des parties:', error)); // Gestion des erreurs
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-grilles-public") {

            // Envoyer les données au serveur
            fetch('app/controllers/ajax/load_liste_grille.php', {
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
        
        
                window.location.href = 'index.php?p=ajouter_grille'; // Redirigez vers une page spécifique
        
            
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "logout") {
        
            fetch('app/controllers/ajax/logout.php')
            .then(() => {
                window.location.href = 'index.php'; // Redirigez vers une page spécifique
            })
            .catch(error => console.error('Erreur lors de la déconnexion:', error));
            
        }
    });
    console.log("Grille à supprimer : ");
    //-----------------TABLEAU DES GRILLES--------------

  
   
    
    







});