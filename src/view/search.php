<?php
include_once 'header.php'; // Inclure l'en-tête
?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/search.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="event-search-container">
        <h2>Rechercher un événement par ID</h2>

        <!-- Formulaire pour entrer l'ID de l'événement -->
        <form action="/search" method="POST">
            <label for="event_id">Entrez l'identifiant de l'événement :</label>
            <input type="number" id="event_id" name="event_id" required placeholder="Identifiant de l'événement">
            <input type="submit" value="Rechercher">
        </form>

        <!-- Conteneur pour les détails de l'événement -->
        <div class="event-details">
            <?php if (isset($data['id'])) {
                echo "<h2>" . $data['title'] . "</h2>";
                echo "<h4>" . $data['description'] . "</h4>";
                echo "<p>Créé par : " . $data['createdBy'] . "</p>";
                echo "<p> Termine le : ". $data['end'] . "</p>";

                // Bouton pour consulter l'événement
                echo "<form action='/display' method='POST' style='display:inline;'>";
                echo "<input type='hidden' name='event_id' value='" . htmlspecialchars($data['id']) . "'>";
                echo "<button type='submit'>Voir l'événement</button>";
                echo "</form>";
            } ?>
        </div>
    </div>
</main>

<?php
include_once 'footer.php'; // Inclure le pied de page
?>
