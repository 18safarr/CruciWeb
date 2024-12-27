function deleteGrid(gridId) {
    if (confirm("Voulez-vous vraiment supprimer cette grille ?")) {
        // Envoi de la requête AJAX pour supprimer la grille
        fetch('app/controllers/ajax/deleteGrille.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idGrille: gridId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //alert('Grille supprimée avec succès.');
                // Supprimer la ligne de la grille dans le tableau
                const link = document.querySelector(`a[onclick='deleteGrid(${gridId})']`);
                if (link) {
                    link.closest('tr').remove();
                }
            } else {
                alert('Erreur lors de la suppression.');
            }
        })
        .catch(error => console.error('Erreur :', error));
    }
}