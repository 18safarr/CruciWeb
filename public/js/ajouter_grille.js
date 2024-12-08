document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector("table");

    // Gestion des clics sur les cellules de la grille
    table.addEventListener("click", function (event) {
        const cell = event.target;

        // Vérifier si l'élément cliqué est une cellule (TD)
        if (cell.tagName === "TD") {
            // Ajouter ou basculer entre les classes "white-cell" et "black-cell"
            if (!cell.classList.contains("black-cell") && !cell.classList.contains("white-cell")) {
                cell.classList.add("black-cell"); // Par défaut, devient noire
            } else if (cell.classList.contains("white-cell")) {
                cell.classList.remove("white-cell");
                cell.classList.add("black-cell");
            } else if (cell.classList.contains("black-cell")) {
                cell.classList.remove("black-cell");
                cell.classList.add("white-cell");
            }
        }
    });

    // Conteneurs pour les définitions verticales et horizontales
    const verticalDefinitionsScroll = document.querySelector(".defVertical .definitions-scroll");
    const horizontalDefinitionsScroll = document.querySelector(".defHorizontal .definitions-scroll");

    // Boutons pour ajouter des définitions
    const addVertiDefinitionBtn = document.getElementById("add-vertical-definition");
    const addHoriDefinitionBtn = document.getElementById("add-horizontal-definition");

    // Ajouter une définition verticale
    addVertiDefinitionBtn.addEventListener("click", function () {
        const newDef = document.createElement("div");
        newDef.classList.add("definition");
        newDef.innerHTML = `
            <label>N°</label>
            <input type="text" class="def-num" placeholder="a, b, c..." maxlength="1" >
            <label>Description</label>
            <input type="text" class="def-desc" placeholder="Définition">
            <label>Solution</label>
            <input type="text" class="def-sol" placeholder="Solution">
            <button class="supp-def">X</button>
        `;
        // Insérer la nouvelle définition au début de la liste
        verticalDefinitionsScroll.insertBefore(newDef, verticalDefinitionsScroll.firstChild);

        // Gérer la suppression
        handleRemoveDefinition(newDef);
    });

    // Ajouter une définition horizontale
    addHoriDefinitionBtn.addEventListener("click", function () {
        const newDef = document.createElement("div");
        newDef.classList.add("definition");
        newDef.innerHTML = `
            <label>N°</label>
            <input type="text" class="def-num" placeholder="1, 2, 3..." maxlength="1" >
            <label>Description</label>
            <input type="text" class="def-desc" placeholder="Définition">
            <label>Solution</label>
            <input type="text" class="def-sol" placeholder="Solution">
            <button class="supp-def">X</button>
        `;
        // Insérer la nouvelle définition au début de la liste
        horizontalDefinitionsScroll.insertBefore(newDef, horizontalDefinitionsScroll.firstChild);

        // Gérer la suppression
        handleRemoveDefinition(newDef);
    });

    // Fonction pour gérer la suppression d'une définition
    function handleRemoveDefinition(definition) {
        const removeBtn = definition.querySelector(".supp-def");
        removeBtn.addEventListener("click", function () {
            definition.remove();
        });
    }

    document.getElementById('generate-grid').addEventListener('click', function() {
        // Récupérer les dimensions de la grille
        const cols = document.getElementById('grid-size-x').value;
        const rows = document.getElementById('grid-size-y').value;
    
        // Construire l'URL avec les paramètres cols et rows
        const url = new URL(window.location.href);
        url.searchParams.set('cols', cols);
        url.searchParams.set('rows', rows);
    
        // Recharger la page avec les nouveaux paramètres dans l'URL
        window.location.href = url.toString();
    });
    
});
