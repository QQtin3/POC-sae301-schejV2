<?php include_once 'header.php'; ?>
    <head>
        <title>POC - SchejV2</title>
        <link href="/src/style/index.css" rel="stylesheet" type="text/css">
    </head>
    <main>
        <div class="main-container">
            <?php if (isset($_SESSION['user'])): ?>
                <?php if (isset($data['message'])) {
                    echo "<script>alert('" . htmlspecialchars($data['message']) . "');</script>";  // Met une alerte avec le message
                } ?>

                <!-- Si l'utilisateur est connecté -->
                <div class="user-info">
                    <p>Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> !</p>
                    <p>Voici un récapitulatif de vos événements créés :</p>

                    <!-- Liste des événements -->
                    <ul class="event-list">
                        <?php if (isset($data['events'])) {
                            foreach ($data['events'] as $datum) {
                                echo "<li>";

                                // Ajouter les données de chaque événement
                                echo "<h3 class='event-list'>" . $datum['name'] . "</h3>";
                                echo "<p class='event-list'>" . $datum['description'] . "</p>";
                                echo "<p class='event-date'> Date de fin : " . $datum['end'] . "</p>";
                                echo "<p class='event-lest'> Identifiant unique : " . $datum['id'];


                                // Bouton pour supprimer l'événement
                                echo "<form action='/delete' method='POST' style='display:inline;'>";
                                echo "<input type='hidden' name='event_id' value='" . htmlspecialchars($datum['id']) . "'>";
                                echo "<button type='submit'>Supprimer l'événement</button>";
                                echo "</form>";

                                // Bouton pour consulter l'événement
                                echo "<form action='/display' method='POST' style='display:inline;'>";
                                echo "<input type='hidden' name='event_id' value='" . htmlspecialchars($datum['id']) . "'>";
                                echo "<button type='submit'>Voir l'événement</button>";
                                echo "</form>";


                                echo "</li>";
                            }
                        } else {
                            echo "<p> Vous n'avez pas encore créé d'événement </p>";
                        }
                        ?>
                        <!-- Ajouter dynamiquement d'autres événements ici -->
                    </ul>
                </div>
            <?php else: ?>
                <div class="project-presentation">
                    <h2>Bienvenue sur notre plateforme de gestion d'événements !</h2>
                    <p>Notre projet permet aux utilisateurs de créer et de gérer leurs événements en toute simplicité.
                        Inscrivez-vous ou connectez-vous pour commencer à organiser vos événements dès maintenant.</p>

                    <!-- Ajout d'une image représentative -->
                    <img src="/src/img/logo.jpg" alt="Image de présentation du projet">
                </div>
            <?php endif; ?>
        </div>
    </main>
<?php include_once 'footer.php'; ?>

