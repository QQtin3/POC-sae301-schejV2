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

function removeChoice(id) {
    const choiceDiv = document.getElementById('choice-' + id);
    choiceDiv.remove();
}

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
    if (differenceInDays > 14) {
        showAlerte('La durée totale de l\'événement ne peut pas dépasser 14 jours.');
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