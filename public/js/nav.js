document.addEventListener("DOMContentLoaded", function () {

    const loginForm = document.querySelector("#login-form");
    if (loginForm) { // Vérifie si le formulaire existe
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            const formData = new FormData(loginForm);

            fetch("../app/ajax/login.php", {
                method: "POST",
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        urlComplete = window.location.href; // page courant
                        window.location.href = urlComplete;
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


    // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-mes-grilles") {

            window.location.href = '../public'; // Redirigez vers une page spécifique
            

            //apres  auto clique pour charger les grilles pivee
        }
    });

    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-grilles-public") {
            window.location.href = '../public'; // Redirigez vers une page spécifique

    
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
                urlComplete = window.location.href; // page courant
                window.location.href = urlComplete;
                
            })
            .catch(error => console.error('Erreur lors de la déconnexion:', error));
             
        }
    });



    



 
    


});
