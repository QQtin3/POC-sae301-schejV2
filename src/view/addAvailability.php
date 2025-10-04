<?php include_once 'header.php'; ?>
    <head>
        <title>POC - SchejV2</title>
        <link href="/src/style/displayEvent.css" rel="stylesheet" type="text/css">
    </head>
    <main>
        <div class="event-container">
            <!-- Section des détails de l'événement -->
            <div class="event-details">
                <h1><?php echo $data['title']; ?></h1>
                <p><?php echo $data['description']; ?></p>
                <p class="event-author">Créé par : <?php echo $data['author']; ?></p>
            </div>

            <!-- Formulaire pour soumettre les disponibilités -->
            <form action="/add_availability" method="POST">

                <!-- input caché pour sauvegarder les cases sélectionnées -->
                <input type="hidden" name="selected_availabilities" id="selected_availabilities">

                <!-- Calendrier -->
                <table class="schedule-table">
                    <caption>Calendrier</caption>
                    <thead>
                    <tr>
                        <th>Heure</th>
                        <!-- Générer dynamiquement les 7 jours -->
                        <?php for ($i = 0; $i < $data['nbDaysInEvent']; $i++): ?>
                            <th><?php
                                $timestampStart = strtotime($data['startDay']);
                                echo date('D, d', strtotime("+$i days", $timestampStart)); ?></th>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Création des heures (par exemple de 8h à 18h) -->
                    <?php for ($hour = 8; $hour <= 23; $hour++): ?>
                        <tr>
                            <td><?php echo $hour . ":00"; ?></td>
                            <!-- Création des créneaux horaires pour chaque jour -->
                            <?php for ($i = 0; $i < $data['nbDaysInEvent']; $i++): ?>
                                <td class="checkbox-cell" id="<?php echo $hour . '_' . $i; ?>"
                                    data="<?php echo $hour . '_' . $i; ?>" onclick="toggleCell(this)"></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>

                <!-- Section de droite : Boutons -->
                <div class="right-container" style="display: flex;">
                    <input type="hidden" name="eventId" value="<?php echo $data['eventId'] ?>">
                    <input type="submit" value="Confirmer">
            </form>
            <!-- Annuler button as part of another form, aligned horizontally -->
            <form action="/display" method="POST">
                <input type="hidden" name="event_id" value="<?php echo $data['eventId'] ?>">
                <input type="submit" id="best-options" value="Annuler">
            </form>
        </div>
        <script src="/src/script/addAvailability.js"></script>
    </main>
<?php include_once 'footer.php'; ?>

