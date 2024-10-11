<?php include 'header.php'; ?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/createEvent.css" rel="stylesheet" type="text/css">
</head>
<main>
    <script src="/src/script/createEvent.js"></script>
    <div class="create-event-container">
        <h2>Créer un Nouvel Événement</h2>

        <!-- Formulaire de création d'événement -->
        <form action="/createEvent" method="POST" onsubmit="return validateDates()">
            <!-- Champ Titre de l'événement -->
            <label for="title">Titre de l'événement (obligatoire)</label>
            <input type="text" id="title" name="title" required placeholder="Titre de votre événement">

            <!-- Champ Description de l'événement -->
            <label for="description">Description (optionnel)</label>
            <textarea id="description" name="description" rows="4" placeholder="Ajoutez une description (optionnel)"></textarea>

            <!-- Champ Date de début -->
            <label for="start_date">Date et heure de début</label>
            <input type="datetime-local" id="start_date" name="start_date" required>

            <!-- Champ Date de fin -->
            <label for="end_date">Date et heure de fin</label>
            <input type="datetime-local" id="end_date" name="end_date" required>

            <!-- Section pour ajouter des choix supplémentaires -->
            <div class="option-container">
                <label for="choices">Choix supplémentaires (optionnels)</label>
                <div id="choice-list"></div>

                <!-- Bouton pour ajouter un choix -->
                <button type="button" onclick="addChoice()">Ajouter un choix</button>
            </div>

            <!-- Bouton de soumission -->
            <input type="submit" value="Créer l'événement">
        </form>
    </div>

    <!-- Alertee personnalisée pour les erreurs -->
    <div id="errorAlerte" class="alerte">
        <div class="alerte-content">
            <p id="alerte-message">Erreur</p>
            <button onclick="closeAlerte()">Fermer</button>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
