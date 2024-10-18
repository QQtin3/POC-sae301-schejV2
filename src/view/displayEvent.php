<?php include 'header.php'; ?>
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
                <!-- Calendrier -->
                <table class="schedule-table">
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
                                <?php
                                $nbParticipants = $data['nbParticipants'];
                                $id = $hour . '_' . $i;

                                $nbParticipantsForId = $data['availabilities'][$id];

                                if ($nbParticipants > 0) {
                                    $pourcentage = $nbParticipantsForId / $nbParticipants;
                                } else {
                                    $pourcentage = 0;
                                }
                                // Interpolation entre blanc (255, 255, 255) et le vert maximum souhaité (135, 255, 135)
                                // Afin que les cases soient entre la couleur blanche (0 disponible) et vert clair (100% disponible)
                                $redColor = intval(255 - ($pourcentage * (255 - 120)));
                                $greenColor = 255;
                                $blueColor = intval(255 - ($pourcentage * (255 - 120)));
                                ?>
                                <td class="checkbox-cell" id="<?php echo $id; ?>"
                                    style="background-color: rgb(<?php echo $redColor ?>, <?php echo $greenColor ?>, <?php echo $blueColor ?>)">
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
                <p id="nbParticipants">Nombre de participants : <?php echo $data['nbParticipants']; ?></p>


                <!-- Section du bas : Boutons -->
                <div class="right-container">
                    <input type="hidden" name="wannaAdd" value="true">
                    <input type="hidden" name="eventId" value="<?php echo $data['eventId']; ?>">
                    <?php

                    $currentTime= new DateTime();
                    $end_time = new DateTime($data['startDay']);
                    $end_time->modify("+ {$data['nbDaysInEvent']} days");
                    if ($currentTime > $end_time) {
                        echo "<div class='tooltip-container'>"; // Container pour le tooltip
                        echo "<input type='submit' value='Ajouter des disponibilités' disabled>";
                        echo "<span class='tooltip'>Vous ne pouvez pas ajouter de disponibilité si la date de fin est déjà passée.</span>";  // Tooltip pour afficher la raison
                        echo "</div>";
                    } else if (isset($data['userAlreadyAnswered'])) {
                        echo "<div class='tooltip-container'>"; // Container pour le tooltip
                        if ($data['userAlreadyAnswered']) {
                            echo "<input type='submit' value='Ajouter des disponibilités' disabled>";
                            echo "<span class='tooltip'>Vous avez déjà indiqué vos disponibilités.</span>";  // Tooltip pour afficher la raison
                        } else {
                            echo "<input type='submit' value='Ajouter des disponibilités'>";
                        }
                        echo "</div>";
                    } else {
                        echo "<div class='tooltip-container'>"; // Container pour le tooltip
                        echo "<input type='submit' value='Ajouter des disponibilités' disabled>";
                        echo "<span class='tooltip'>Vous ne pouvez pas ajouter de disponibilité si vous n'êtes pas connecté.</span>";  // Tooltip pour afficher la raison
                        echo "</div>";
                    }

                    ?>

                    <input type="button" id="best-options" value="Voir les meilleurs créneaux"
                           onclick="viewBestSlots()">
                </div>
            </form>
        </div>
        <script src="/src/script/displayEvent.js"></script>
    </main>
<?php include 'footer.php'; ?>