function loadForm(formType) {
    const rightContainer = document.getElementById("right-container");

    // Détermine quel formulaire charger
    let url = "";
    if (formType === "connexion") {
        url = "../pages/connexion_form.php";
    } else if (formType === "inscription") {
        url = "../pages/inscription_form.php";
    }

    // Effectuer une requête AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Charger le contenu dans le conteneur
            rightContainer.innerHTML = xhr.responseText;
        } else {
            console.error("Erreur lors du chargement du formulaire");
        }
    };

    xhr.onerror = function () {
        console.error("Erreur réseau lors de la requête AJAX");
    };

    xhr.send();
}
