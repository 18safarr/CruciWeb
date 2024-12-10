document.addEventListener("DOMContentLoaded", function () {
    // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    document.addEventListener("click", function (e) {
        // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-grilles'
        if (e.target && e.target.id === "voir-mes-grilles") {
           

            // Envoyer les données au serveur
            fetch('../app/load_liste_grille.php', {
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
            fetch('../app/load_liste_grille.php', {
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
});
