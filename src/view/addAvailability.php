<?php include 'header.php'; ?>
    <head>
        <title>POC - SchejV2</title>
        <link href="/src/style/displayEvent.css" rel="stylesheet" type="text/css">
    </head>
    <main>
        <div class="event-container">
            <!-- Section des détails de l'événement -->
            <div class="event-details">
                <h1><?php echo "name"; ?></h1>
                <p><?php echo "desc"; ?></p>
                <p class="event-author">Créé par : Auteur</p>
            </div>

            <!-- Navigation des semaines -->
            <div class="week-nav">
                <button id="prev-week" disabled>Semaine précédente</button>
                <button id="next-week">Semaine suivante</button>
            </div>

            <!-- Formulaire pour soumettre les disponibilités -->
            <form action="/add_availability" method="POST">
                <!-- Calendrier -->
                <table class="schedule-table">
                    <thead>
                    <tr>
                        <th>Heure</th>
                        <!-- Générer dynamiquement les 7 jours -->
                        <?php for ($i = 0; $i < 7; $i++): ?>
                            <th><?php echo date('D, d', strtotime("+$i days", 1729154793)); ?></th>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Création des heures (par exemple de 8h à 18h) -->
                    <?php for ($hour = 8; $hour <= 18; $hour++): ?>
                        <tr>
                            <td><?php echo $hour . ":00"; ?></td>
                            <!-- Création des créneaux horaires pour chaque jour -->
                            <?php for ($i = 0; $i < 7; $i++): ?>
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="availability[]"
                                           value="<?php echo $hour . '_' . $i; ?>">
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>

                <!-- Section de droite : Boutons -->
                <div class="right-container">
                    <input type="submit" value="Confirmer">
                    <input type="button" value="Annuler" onclick="window.history.back();"> <!-- renvoie à la page précédente -->
                </div>
            </form>
        </div>
        <script src="/src/script/displayEvent.js"></script>
    </main>
<?php include 'footer.php'; ?>