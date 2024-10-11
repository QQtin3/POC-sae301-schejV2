<?php include 'header.php'; ?>

<main>
    <style>
        /* Style général pour le container principal */
        .main-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1c712e;
        }

        /* Style pour la section de l'utilisateur connecté */
        .user-info {
            margin-bottom: 20px;
            text-align: center;
            color: #343a40;
            font-size: 1.2rem;
        }

        /* Style pour les événements */
        .event-list {
            list-style-type: none;
            padding: 0;
        }

        .event-list li {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .event-list li h3 {
            margin: 0;
            color: #1c712e;
        }

        .event-list li p {
            margin: 5px 0;
            color: #343a40;
        }

        .event-list li .event-date {
            font-weight: bold;
            color: #28a745;
        }

        /* Style pour la section de présentation */
        .project-presentation {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }

        .project-presentation img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .project-presentation p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #343a40;
        }

    </style>

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
                <p>Notre projet permet aux utilisateurs de créer et de gérer leurs événements en toute simplicité. Inscrivez-vous ou connectez-vous pour commencer à organiser vos événements dès maintenant.</p>

                <!-- Ajout d'une image représentative -->
                <img src="images/event_planning.jpg" alt="Image de présentation du projet">
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>