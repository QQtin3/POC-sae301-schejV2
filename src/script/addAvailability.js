// Va sauvegarder l'ensemble des créneaux sélectionnés
let selectedAvailabilities = []

// Permet de gérer le changement de couleurs des cellules et de l'envoi en PHP au format JSON
function toggleCell(cell) {
    const time = cell.getAttribute('data');

    // Si la cellule est déjà sélectionnée
    if (selectedAvailabilities.includes(time)) {
        selectedAvailabilities.splice(selectedAvailabilities.indexOf(time), 1);  // On enlève la case du tableau
        cell.style.backgroundColor = "";
    } else {
        // On ajoute la cellule aux disponibilités et on change la couleur du background
        selectedAvailabilities.push(time);
        cell.style.backgroundColor = 'lightgreen';
    }

    // On met à jour l'input caché avec toutes les cases actuellement cochées
    document.getElementById('selected_availabilities').value = JSON.stringify(selectedAvailabilities);
}