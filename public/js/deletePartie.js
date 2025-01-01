function deletePartie(partieId) {
    if (confirm("Voulez-vous vraiment supprimer cette partie ?")) {
        // Envoi de la requête AJAX pour supprimer la partie
        fetch('app/controllers/ajax/deletePartie.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idPartie: partieId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //alert('partie supprimée avec succès.');
                // Supprimer la ligne de la partie dans le tableau
                const link = document.querySelector(`a[onclick='deletePartie(${partieId})']`);
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