// Fonction pour ajouter des choix supplémentaires
let choiceCount = 0;

function addChoice() {
    choiceCount++;
    const choiceList = document.getElementById('choice-list');
    const choiceDiv = document.createElement('div');
    choiceDiv.setAttribute('id', 'choice-' + choiceCount);
    choiceDiv.classList.add('option-input');

    choiceDiv.innerHTML = `
                <input type="text" name="choices[]" placeholder="Nom du choix" required>
                <button type="button" class="remove-btn" onclick="removeChoice(${choiceCount})">Supprimer</button>
            `;
    choiceList.appendChild(choiceDiv);
}
// FONCTION NON IMPLÉMENTÉE EN RÉEL CI-DESSUS


function removeChoice(id) {
    const choiceDiv = document.getElementById('choice-' + id);
    choiceDiv.remove();
}

// Fait des vérifications sur la validité des dates
function validateDates() {
    const startDate = new Date(document.getElementById('start_date').value);
    const endDate = new Date(document.getElementById('end_date').value);

    // Vérifie que la date de fin est bien après la date de début
    if (endDate <= startDate) {
        showAlerte('La date de fin doit être après la date de début.');
        return false;
    }

    // Vérifie que l'événement ne dépasse pas 14 jours
    const differenceInDays = (endDate - startDate) / (1000 * 60 * 60 * 24);
    if (differenceInDays > 7) {
        showAlerte('La durée totale de l\'événement ne peut pas dépasser 7 jours.');
        return false;
    }

    if (startDate < Date.now()) {
        showAlerte('La date de début ne peut pas être dans le passé');
        return false;
    }
    return true;
}

function showAlerte(message) {
    document.getElementById('alerte-message').textContent = message;
    document.getElementById('errorAlerte').style.display = 'block';
}

function closeAlerte() {
    document.getElementById('errorAlerte').style.display = 'none';
}