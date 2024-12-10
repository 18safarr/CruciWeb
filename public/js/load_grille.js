// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function () {
    /**
     * Générer une nouvelle grille
     * Ce bouton envoie une requête POST au serveur pour générer une grille.
     * Les dimensions de la grille (colonnes et lignes) sont saisies par l'utilisateur.
     * 
     * La grille est ensuite affichée dans le conteneur #crossword.
     */
    document.getElementById('generate-grid').addEventListener('click', function() {
        const cols = document.getElementById('grid-size-x').value; // Nombre de colonnes
        const rows = document.getElementById('grid-size-y').value; // Nombre de lignes
    
        // Envoyer les données au serveur
        fetch('../app/loadGrille.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cols=${cols}&rows=${rows}` // Paramètres envoyés au serveur
        })
        .then(response => response.text()) // Récupération de la réponse sous forme de texte
        .then(html => {
            document.getElementById('crossword').innerHTML = html; // Injection de la grille reçue du serveur
        })
        .catch(error => console.error('Erreur lors du chargement de la grille:', error)); // Gestion des erreurs
    });

});
