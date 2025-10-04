<?php include_once 'header.php'; ?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/createEvent.css" rel="stylesheet" type="text/css">
</head>
<main>

    <!-- Check si l'utilisateur est connecté, sinon le redirige vers la page de connexion au bout de 2 secondes -->
    <?php if (!isset($_SESSION['user'])): ?>
        <div class="alerte alerte-content" role="alert">
            <b>Vous devez être connecté pour créer un événement. Redirection vers la page de connexion...</b>
        </div>

        <script>
            // Redirection automatique après 3 secondes
            setTimeout(function() {
                window.location.href = '/connect';
            }, 2000);
        </script>
    <?php endif ?>


    <!-- Si les données ont bien été insérées (et donc l'event créé) -->
    <?php if (isset($data['dataInserted'])): ?>
        <div class="alerte alerte-content" role="alert">
            <b>Votre événement a bien été créé !</b>
        </div>
    <?php endif ?>


    <script src="/src/script/createEvent.js"></script>
    <div class="create-event-container">
        <h2>Créer un Nouvel Événement</h2>

        <!-- Formulaire de création d'événement -->
        <form action="/create" method="POST" onsubmit="return validateDates()">
            <!-- Champ Titre de l'événement -->
            <label for="title">Titre de l'événement (obligatoire)</label>
            <input type="text" id="title" name="title" required placeholder="Titre de votre événement">

            <!-- Champ Description de l'événement -->
            <label for="description">Description (optionnel)</label>
            <textarea id="description" name="description" rows="4" placeholder="Ajoutez une description (optionnel)"></textarea>

            <!-- Champ Date de début -->
            <label for="start_date">Date de début</label>
            <input type="date" id="start_date" name="start_date" required>

            <!-- Champ Date de fin -->
            <label for="end_date">Date de fin</label>
            <input type="date" id="end_date" name="end_date" required>

            <!-- Bouton de soumission -->
            <input type="submit" value="Créer l'événement">
        </form>
    </div>

    <!-- Alerte personnalisée pour les erreurs -->
    <div id="errorAlerte" class="alerte">
        <div class="alerte-content">
            <p id="alerte-message">Erreur</p>
            <button onclick="closeAlerte()">Fermer</button>
        </div>
    </div>
</main>

<?php include_once 'footer.php'; ?>
