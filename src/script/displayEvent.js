// Correspond au décalage de semaine ou non (si l'évènement dure + de 7 jours)
let weekOffset = 0;

// Les bouttons de changement de semaine
const nxt_button = document.getElementById('next-week');
const prev_button = document.getElementById('prev-week');

// Ajoute des listener pour la gestion d'un click utilisateur
nxt_button.addEventListener('click', nextDays);
prev_button.addEventListener('click', previousDays);

// Fonctions pour la navigation des jours du calendrier

// Afficher les 7 jours précédents
function previousDays() {
    if (weekOffset > 0) {  // Sécurité
        weekOffset = 0;
        nxt_button.removeAttribute('disabled');  // Débloque l'autre bouton
        prev_button.setAttribute('disabled', 'true');
    }
}

// Afficher les 7 jours suivants
function nextDays() {
    if (weekOffset === 0) {  // Sécurité
        weekOffset = 1;
        nxt_button.setAttribute('disabled', 'true');
        prev_button.removeAttribute('disabled');
    }
}

// Fonction pour ajouter des disponibilités
function addAvailability() {
    // Logique pour ajouter des disponibilités
    alert("Ajout de vos disponibilités");
}

// Fonction pour voir les meilleurs créneaux
function viewBestSlots() {
    // Logique pour afficher les meilleurs créneaux disponibles
    alert("Affichage des meilleurs créneaux possibles");
}