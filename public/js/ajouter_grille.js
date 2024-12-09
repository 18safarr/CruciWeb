// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function () {

    // Sélection de la table de la grille
    const table = document.querySelector("table");
    
    /**
     * Événement de clic sur les cellules de la grille
     * Permet de basculer entre une cellule blanche et une cellule noire.
     * On utilise la délégation d'événements en attachant l'écouteur sur le parent (#crossword)
     * 
     * Lorsqu'une cellule (TD) est cliquée, on applique ou on retire la classe "black-cell"
     */
    document.getElementById('crossword').addEventListener('click', function(event) {
        if (event.target.tagName === 'TD') {
            event.target.classList.toggle('black-cell'); // Ajoute ou retire la classe "black-cell"
        }
    });

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

    /**
     * Conteneurs des définitions verticales et horizontales
     * Ces conteneurs affichent la liste des définitions ajoutées par l'utilisateur.
     */
    const verticalDefinitionsScroll = document.querySelector(".defVertical .definitions-scroll");
    const horizontalDefinitionsScroll = document.querySelector(".defHorizontal .definitions-scroll");

    // Boutons pour ajouter de nouvelles définitions verticales et horizontales
    const addVertiDefinitionBtn = document.getElementById("add-vertical-definition");
    const addHoriDefinitionBtn = document.getElementById("add-horizontal-definition");

    /**
     * Ajouter une nouvelle définition verticale
     * Ce bouton permet d'ajouter une nouvelle définition pour la grille verticale.
     * La définition comprend un champ "N°", un champ "Description" et un champ "Solution".
     * Un bouton "X" permet de supprimer la définition.
     */
    addVertiDefinitionBtn.addEventListener("click", function () {
        const newDef = document.createElement("div"); // Crée un conteneur pour la nouvelle définition
        newDef.classList.add("definition"); // Ajoute la classe .definition
        newDef.innerHTML = `
            <label>N°</label>
            <input type="text" class="def-num" placeholder="a, b, c..." maxlength="1">
            <label>Description</label>
            <input type="text" class="def-desc" placeholder="Définition">
            <label>Solution</label>
            <input type="text" class="def-sol" placeholder="Solution">
            <button class="supp-def">X</button>
        `;

        // Ajoute la nouvelle définition au début de la liste des définitions verticales
        verticalDefinitionsScroll.insertBefore(newDef, verticalDefinitionsScroll.firstChild);

        // Attache un gestionnaire d'événement pour le bouton de suppression
        handleRemoveDefinition(newDef);
    });

    /**
     * Ajouter une nouvelle définition horizontale
     * Ce bouton permet d'ajouter une nouvelle définition pour la grille horizontale.
     * La définition comprend un champ "N°", un champ "Description" et un champ "Solution".
     * Un bouton "X" permet de supprimer la définition.
     */
    addHoriDefinitionBtn.addEventListener("click", function () {
        const newDef = document.createElement("div"); // Crée un conteneur pour la nouvelle définition
        newDef.classList.add("definition"); // Ajoute la classe .definition
        newDef.innerHTML = `
            <label>N°</label>
            <input type="text" class="def-num" placeholder="1, 2, 3..." maxlength="1">
            <label>Description</label>
            <input type="text" class="def-desc" placeholder="Définition">
            <label>Solution</label>
            <input type="text" class="def-sol" placeholder="Solution">
            <button class="supp-def">X</button>
        `;

        // Ajoute la nouvelle définition au début de la liste des définitions horizontales
        horizontalDefinitionsScroll.insertBefore(newDef, horizontalDefinitionsScroll.firstChild);

        // Attache un gestionnaire d'événement pour le bouton de suppression
        handleRemoveDefinition(newDef);
    });

    /**
     * Fonction pour gérer la suppression d'une définition
     * Lorsqu'on clique sur le bouton "X", la définition correspondante est supprimée de la liste.
     * 
     * @param {HTMLElement} definition - L'élément de définition à supprimer
     */
    function handleRemoveDefinition(definition) {
        const removeBtn = definition.querySelector(".supp-def"); // Sélectionne le bouton de suppression
        removeBtn.addEventListener("click", function () {
            definition.remove(); // Supprime la définition du DOM
        });
    }


    function getBlackCells() {
        const blackCells = document.querySelectorAll('#crossword td.black-cell'); // Sélectionne toutes les cellules noires
        const blackCellPositions = []; // Tableau qui contiendra les positions des cellules noires
    
        blackCells.forEach(cell => {
            const row = cell.parentElement.rowIndex; // Numéro de la ligne
            const col = cell.cellIndex; // Numéro de la colonne
            blackCellPositions.push({ row: row + 1, col: col }); // On ajoute 1 à la ligne pour qu'elle commence à 1
        });
    
        return blackCellPositions;
    }

    // Exemple d'appel de la fonction
    const blackCells = getBlackCells();
    console.log('Cellules noires:', blackCells);

});
