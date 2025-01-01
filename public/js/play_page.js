document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {

        if (event.target && event.target.id === "save-button") {
        const inputs = document.querySelectorAll("#crossword input[type='text']");
        const filledCells = {};
        inputs.forEach(input => {
            if (input.value.trim() !== "") {
                filledCells[input.name] = input.value.trim(); // Associe "cell_x_y" à sa valeur
            }
        });

        const partieData = {
            contenu: JSON.stringify(filledCells), // Convertit les données en JSON
            dateEnregistrement: new Date().toISOString().split('T')[0], // Date actuelle
            statut: "Sauvegardée",
        };

        console.log(partieData);

        // // Envoi des données via AJAX
        fetch("app/controllers/ajax/save_partie.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(partieData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Partie sauvegardée avec succès !");
                console.log(data.message);
            } else {
                alert("Erreur lors de la sauvegarde de la partie : " + data.message);
            }
        })
        .catch(error => console.error("Erreur lors de l'enregistrement :", error));

    }
    });
    

    // // Attacher un gestionnaire d'événements délégué pour les boutons dynamiques
    // document.addEventListener("click", function (e) {
    //     // Vérifiez si l'élément cliqué est le bouton avec l'ID 'voir-mes-parties'
    //     if (e.target && e.target.id === "voir-mes-parties") {

    //         // Envoyer les données au serveur
    //         fetch('app/controllers/ajax/load_liste_grille.php', {
    //             method: 'POST',
    //             headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    //             body: `load-liste-grille=partie` // Paramètres envoyés au serveur
    //         })
    //         .then(response => response.text()) // Récupération de la réponse sous forme de texte
    //         .then(html => {
    //             document.getElementById('grilleTable').innerHTML = html; // Injection de la grille reçue du serveur
    //         })
    //         .catch(error => console.error('Erreur lors du chargement des parties:', error)); // Gestion des erreurs
    //     }
    // });


    
});
