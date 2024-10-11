<?php include 'header.php'; ?>
    <head>
        <link href="/src/style/index.css" rel="stylesheet" type="text/css">
    </head>
    <main>
        <div class="main-container">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- Si l'utilisateur est connecté -->
                <div class="user-info">
                    <p>Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> !</p>
                    <p>Voici un récapitulatif de vos événements créés :</p>

                    <!-- Liste des événements (exemple statique, à remplacer par des données dynamiques) -->
                    <ul class="event-list">
                        <li>
                            <h3>Nom de l'événement 1</h3>
                            <p>Description de l'événement 1</p>
                            <p class="event-date">Date de début : 12/10/2024</p>
                        </li>
                        <li>
                            <h3>Nom de l'événement 2</h3>
                            <p>Description de l'événement 2</p>
                            <p class="event-date">Date de début : 15/10/2024</p>
                        </li>
                        <!-- Ajouter dynamiquement d'autres événements ici -->
                    </ul>
                </div>
            <?php else: ?>
                <!-- Si l'utilisateur n'est pas connecté -->
                <div class="project-presentation">
                    <h2>Bienvenue sur notre plateforme de gestion d'événements !</h2>
                    <p>Notre projet permet aux utilisateurs de créer et de gérer leurs événements en toute simplicité.
                        Inscrivez-vous ou connectez-vous pour commencer à organiser vos événements dès maintenant.</p>

                    <!-- Ajout d'une image représentative -->
                    <img src="images/event_planning.jpg" alt="Image de présentation du projet">
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php include 'footer.php'; ?>