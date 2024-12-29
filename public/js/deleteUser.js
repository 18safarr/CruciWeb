function deleteUser(userId) {
    if (confirm("Voulez-vous vraiment supprimer cette utilisateur ?")) {
        // Envoi de la requête AJAX pour supprimer l'utilisateur
        fetch('app/controllers/ajax/deleteUser.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idUser: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //alert('user supprimée avec succès.');
                // Supprimer la ligne de la user dans le tableau
                const link = document.querySelector(`a[onclick='deleteUser(${userId})']`);
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