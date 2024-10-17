<?php
include 'header.php'; // Inclure l'en-tête
?>

<main>
    <style>
        /* Style du container de recherche d'événement */
        .event-search-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Titre principal */
        .event-search-container h2 {
            text-align: center;
            color: #28a745;
        }

        /* Style du formulaire */
        .event-search-container form {
            text-align: center;
            margin-top: 20px;
        }

        /* Champs de saisie et bouton */
        .event-search-container input[type="number"],
        .event-search-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        /* Bouton de soumission */
        .event-search-container input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }

        .event-search-container input[type="submit"]:hover {
            background-color: #218838;
        }

        /* Conteneur pour les détails de l'événement */
        .event-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>

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
            } ?>
        </div>
    </div>
</main>

<?php
include 'footer.php'; // Inclure le pied de page
?>
