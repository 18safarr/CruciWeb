function checkGrille(solution) {
    // Si solution est une chaîne, la convertir en objet
    if (typeof solution === "string") {
        try {
            solution = JSON.parse(solution);
        } catch (error) {
            console.error("Erreur lors du parsing de la solution :", error);
            return;
        }
    }

    // Récupérer toutes les cases remplies
    const inputs = document.querySelectorAll("#crossword input[type='text']");
    const filledCells = {};
    inputs.forEach(input => {
        if (input.value.trim() !== "") {
            filledCells[input.name] = input.value.trim(); // Associe "x_y" à sa valeur
        }
    });

    console.log("Cases remplies :", filledCells);

     // Vérifier les cases remplies contre la solution
     let allCorrect = true; // Indique si toutes les cases sont correctes

    if (Object.keys(filledCells).length != Object.keys(solution).length)
        allCorrect = false;

   
    for (const [position, value] of Object.entries(filledCells)) {
        if (solution[position].toUpperCase()  !== value.toUpperCase()) {
            //console.error(`Erreur : La case ${position} est incorrecte (valeur : "${value}" vs "${solution[position]}").`);
            //alert(`Erreur : La case ${position} est incorrecte (valeur : "${value}" vs 😉).`)
            allCorrect = false;

            // Marquer la case comme incorrecte
            const input = document.querySelector(`#crossword input[name='${position}']`);
            if (input) {
                input.style.color = "red";
            }
        } else {
            // Marquer la case comme correcte
            const input = document.querySelector(`#crossword input[name='${position}']`);
            if (input) {
                input.style.color = "green";
            }
        }
    }


    if (allCorrect) {
        console.log("Toutes les cases sont correctes !");
        const partieData = {
            contenu: JSON.stringify(solution), // Convertit les données en JSON
        };

        console.log(partieData);

        // // Envoi des données via AJAX
        fetch("app/controllers/ajax/update_partie.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(partieData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message,"Partie Terminée");
                console.log(data.message);
            } else {
                alert("Erreur lors de la sauvegarde de la partie : " + data.message);
            }
        })
        .catch(error => console.error("Erreur lors de l'enregistrement :", error));
        
    } else {
       // alert("Certaines cases sont incorrectes. Vérifiez vos réponses.");
    }


    

    // Parcourt tous les champs pour leur attacher un gestionnaire d'événement
    inputs.forEach(input => {
        // Lorsqu'une touche est pressée (ou une valeur modifiée)
        input.addEventListener("input", function () {
            if (this.style.color === "red") {
                this.style.color = "black"; // Remet la couleur à noir
            }
        });

        // Pour simuler une vérification et rendre rouge
        input.addEventListener("blur", function () {
            if (!this.value.trim()) {
                this.style.color = "red"; // Met en rouge si vide après avoir perdu le focus
            }
        });
    });
}
