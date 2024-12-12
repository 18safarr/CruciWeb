document.addEventListener("DOMContentLoaded", function () {
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
           
            fetch('../app/logout.php')
            .then(() => {
                window.location.href = '../public'; // Redirigez vers une page spécifique
            })
            .catch(error => console.error('Erreur lors de la déconnexion:', error));
             
        }
    });



 
    


});
