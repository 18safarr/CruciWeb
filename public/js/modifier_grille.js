// Attendre que le DOM soit entièrement chargé avant d'exécuter le script
document.addEventListener("DOMContentLoaded", function () {

        const definitions = document.querySelectorAll(".definitions-scroll > div"); // Select all divs inside .definitions-scroll
        definitions.forEach(definition => {
          handleRemoveDefinition(definition); // Attach the event listener to each definition
        });

      
      
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
     * Générer une nouvelle grille à partir des listes déroulantes
     * Ce script remplace le bouton "Générer" par l'interaction directe avec les listes déroulantes.
     * Lorsqu'une des listes est modifiée, une nouvelle grille est générée.
     */

      document.addEventListener("change", function (e) {
        // Vérifier si l'événement provient des listes déroulantes
        if (e.target && (e.target.id === "grid-size-x" || e.target.id === "grid-size-y")) {
            const cols = document.getElementById('grid-size-x').value; // Nombre de colonnes
            const rows = document.getElementById('grid-size-y').value; // Nombre de lignes

            // Envoyer les données au serveur
            fetch('app/controllers/ajax/loadGrille.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `cols=${cols}&rows=${rows}` // Paramètres envoyés au serveur
            })
            .then(response => response.text()) // Récupération de la réponse sous forme de texte
            .then(html => {
                document.getElementById('crossword').innerHTML = html; // Injection de la grille reçue du serveur
            })
            .catch(error => console.error('Erreur lors du chargement de la grille:', error)); // Gestion des erreurs
        }
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
     */
    addVertiDefinitionBtn.addEventListener("click", function () {
        const vt = document.getElementById("vertical-template");
    
        // Clone le modèle pour créer une nouvelle définition
        const newDef = vt.cloneNode(true);
        newDef.removeAttribute("id"); // Supprime l'ID pour éviter les conflits
        console.log(newDef.getAttribute('data-id'));
        
        newDef.setAttribute("data-id", "new");
        
        // Vider le contenu des champs d'entrée dans le clone
        const inputs = newDef.querySelectorAll("input");
        inputs.forEach(input => {
            input.value = ""; // Réinitialise le contenu
        });

        // Ajoute la nouvelle définition au début de la liste des définitions verticales
        verticalDefinitionsScroll.insertBefore(newDef, verticalDefinitionsScroll.firstChild);
    
        // Attache un gestionnaire d'événement pour le bouton de suppression
        handleRemoveDefinition(newDef);
    });

    /**
     * Ajouter une nouvelle définition horizontale
     */
    addHoriDefinitionBtn.addEventListener("click", function () {
        const hz = document.getElementById("horizontal-template");
    
        // Clone le modèle pour créer une nouvelle définition
        const newDef = hz.cloneNode(true);
        newDef.removeAttribute("id"); // Supprime l'ID pour éviter les conflits
        newDef.setAttribute("data-id", "new");
        //console.log(newDef.getAttribute("data-id"));
        // Vider le contenu des champs d'entrée dans le clone
        const inputs = newDef.querySelectorAll("input");
        inputs.forEach(input => {
            input.value = ""; // Réinitialise le contenu
        });
    
        // Ajoute la nouvelle définition au début de la liste des définitions horizontales
        horizontalDefinitionsScroll.insertBefore(newDef, horizontalDefinitionsScroll.firstChild);
    
        // Attache un gestionnaire d'événement pour le bouton de suppression
        handleRemoveDefinition(newDef);
        
    });

    // function checkSingleDefinition() {
    //     const definitions = document.querySelectorAll(".definitions-scroll > div");
    //     if (definitions.length === 1) {
    //       handleRemoveDefinition(definitions[0]); // Attach event listener to the remaining div
    //     }
    //   }

    /**
     * Fonction pour gérer la suppression d'une définition 
     */
    function handleRemoveDefinition(definition) {
        const removeBtn = definition.querySelector(".supp-def"); // Sélectionne le bouton de suppression
        removeBtn.addEventListener("click", function () {
            definition.remove(); // Supprime la définition du DOM
            // checkSingleDefinition();
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


    document.addEventListener("click", function (event) {
        if (event.target && event.target.id === "save-grid") {
            const grilleData = collectGridData();
            console.log(grilleData); // 🔍 Affiche les données collectées

            // Envoi des données au serveur via AJAX
        fetch('app/controllers/ajax/update_grille.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(grilleData)
        })
        .then(response => response.json())
        .then(data => {
            
            if (data.success) {
                alert('Grille modifier avec succès !');
            } else {
                alert(data.message);
                console.log(data.message);
            }
        })
        .catch(error => console.error('Erreur lors de l\'enregistrement de la grille :', error ));

        }
    });

    function collectGridData() {
        const gridName = document.getElementById('grid-name').value;
        const dimX = document.getElementById('grid-size-x').value;
        const dimY = document.getElementById('grid-size-y').value;
        const difficulty = document.getElementById('difficulty').value;
        const published = document.getElementById('publish-yes').checked ? 1 : 0;

        // Récupère les positions des cases noires
        const blackCells = getBlackCells();

        // Collecte des définitions verticales et horizontales
        const verticalDefs = collectDefinitions('.defVertical .definition');
        const horizontalDefs = collectDefinitions('.defHorizontal .definition');

        return {
            nomGrille: gridName,
            dimX: dimX,
            dimY: dimY,
            difficulte: difficulty,
            publiee: published,
            blackCells: blackCells,
            verticalDefs: verticalDefs,
            horizontalDefs: horizontalDefs
        };
    }

    function getBlackCells() {
        const blackCells = document.querySelectorAll('#crossword td.black-cell');
        const blackCellPositions = [];
        
        blackCells.forEach(cell => {
            const row = cell.parentElement.rowIndex;
            const col = cell.cellIndex;
            blackCellPositions.push({ x: row, y: col });
        });

        return blackCellPositions;
    }

    function collectDefinitions(selector) {
        const definitions = [];
        
        document.querySelectorAll(selector).forEach(def => {
            const idDef = def.getAttribute('data-id'); // Récupère l'attribut data-id
            const posX = def.querySelector('#pos-x').value;
            const posY = def.querySelector('#pos-y').value;
            const description = def.querySelector('.def-desc').value;
            const solution = def.querySelector('.def-sol').value;

            definitions.push({idDef, posX, posY, description, solution });
        });

        return definitions;
    }



});
