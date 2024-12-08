// Variables globales pour stocker l'état du tri (croissant ou décroissant)
let sortByDateAscending = true;
let sortByLevelAscending = true;

// Fonction pour trier le tableau par date (croissant/décroissant)
function sortTableByDate() {
    const table = document.getElementById("grilleTable");
    const rows = Array.from(table.rows).slice(1);
    const sortedRows = rows.sort((a, b) => {
        const dateA = new Date(a.cells[4].innerText);
        const dateB = new Date(b.cells[4].innerText);

        // Alterner entre tri croissant et décroissant
        return sortByDateAscending ? dateA - dateB : dateB - dateA;
    });

    // Réinsérer les lignes triées dans le tableau
    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";
    sortedRows.forEach(row => tbody.appendChild(row));

    // Alterner le tri pour le prochain clic
    sortByDateAscending = !sortByDateAscending;
    if(sortByDateAscending){
        document.getElementById("dateSortIcon").innerHTML="▲";
    }else{
        document.getElementById("dateSortIcon").innerHTML="▼";
    }
    document.getElementById("levelSortIcon").innerHTML="&#x25B2;&#x25BC;";
}

// Fonction pour trier le tableau par niveau (croissant/décroissant)
function sortTableByLevel() {
    const table = document.getElementById("grilleTable");
    const rows = Array.from(table.rows).slice(1);
    const levelsOrder = { "Débutant": 1, "Intermédiaire": 2, "Expert": 3 };

    const sortedRows = rows.sort((a, b) => {
        const levelA = a.cells[3].innerText;
        const levelB = b.cells[3].innerText;

        // Alterner entre tri croissant et décroissant
        return sortByLevelAscending
            ? levelsOrder[levelA] - levelsOrder[levelB]
            : levelsOrder[levelB] - levelsOrder[levelA];
    });

    // Réinsérer les lignes triées dans le tableau
    const tbody = table.querySelector("tbody");
    tbody.innerHTML = "";
    sortedRows.forEach(row => tbody.appendChild(row));

    // Alterner le tri pour le prochain clic
    sortByLevelAscending = !sortByLevelAscending;
    if(sortByLevelAscending){
        document.getElementById("levelSortIcon").innerHTML="▲";
    }else{
        document.getElementById("levelSortIcon").innerHTML="▼";
    }
    document.getElementById("dateSortIcon").innerHTML="&#x25B2;&#x25BC;";
}
