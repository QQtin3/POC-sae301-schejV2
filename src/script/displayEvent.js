// Correspond au décalage de semaine ou non (si l'évènement dure + de 7 jours)
let weekOffset = 0;

// Désactive le fait de pouvoir sélectionner les meilleurs créneaux s'il n'y a pas de participant
window.onload = () => {
    const nb_participants = document.getElementById("nbParticipants").innerHTML;
    const lastChar = nb_participants.split(" "); // Le dernier élément est la nombre de participants
    const lastCharInt = parseInt(lastChar[lastChar.length - 1], 10);  // Transforme la chaine de caractère en entier

    // Si pas un entier ou 0 >= nb alors on bloque le bouton
    if (isNaN(lastCharInt) || lastCharInt <= 0) {
        const best_options_button = document.getElementById('best-options');
        best_options_button.setAttribute('disabled', 'true');
    }
}

/*
Fonction pour voir les meilleurs créneaux

Chaque créneau possède une valeur de vert qui est tout le temps la même (voir ligne 51 displayEvent.php)
Le bleu et le rouge ont tout le temps la même valeur également, ainsi, on cherche à obtenir la valeur minimale de rouge
ce qui indique que le vert est plus dominant afin de déterminer quelles sont les meilleures cases
*/


let bestSlotHighlighted = false; // Pour vérifier si les meilleurs créneaux sont déjà affichés
let colors = []; // Pour stocker les couleurs

function viewBestSlots() {
    const all_slots = document.querySelectorAll('td');

    if (!bestSlotHighlighted) {
        colors = []; // Vider les couleurs avant chaque appel

        let minRedValue = 255; // On cherche la plus faible valeur de rouge
        all_slots.forEach(slot => {

            // Récupère la couleur de fond (background-color) de chaque case
            const backgroundColor = window.getComputedStyle(slot).backgroundColor;

            // Extraire la valeur du vert depuis rgb(r, g, b)
            const rgbValues = backgroundColor.match(/\d+/g);
            const redValue = parseInt(rgbValues[0]); // Première valeur dans RGB (r, g, b)
            colors.push({slot: slot, color: backgroundColor});

            // Comparer pour savoir quel vert est le plus vert (meilleur créneau)
            if (redValue !== 0 && redValue < minRedValue) {  // Ne doit pas être égal à 0 (car correspond au blanc)
                minRedValue = redValue;
            }
        });

        // Changer la couleur des créneaux avec la valeur verte la plus intense
        all_slots.forEach(slot => {
            const backgroundColor = window.getComputedStyle(slot).backgroundColor;
            const rgbValues = backgroundColor.match(/\d+/g);
            const redValue = parseInt(rgbValues[0]);

            // Si la couleur rouge est la moins dominante, changer en jaune
            if (redValue === minRedValue) {
                slot.style.backgroundColor = 'yellow';
            }
        });

        bestSlotHighlighted = true; // Indique que les meilleurs créneaux sont affichés
    } else {
        // Remettre les couleurs originales
        colors.forEach(item => {
            item.slot.style.backgroundColor = item.color;
        });

        bestSlotHighlighted = false; // Réinitialiser pour pouvoir réactiver la fonction
    }
}
