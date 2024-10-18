<?php

namespace controller;

use DateTime;
use model\dao\AvailabilityDAO;
use model\dao\EventsDAO;
use model\dao\UserDataDAO;

require_once __ROOT__ . "/model/dao/EventsDAO.php";
require_once __ROOT__ . "/model/dao/UserDataDAO.php";
require_once __ROOT__ . "/model/dao/AvailabilityDAO.php";
require_once CONTROLLER_DIR . '/Controller.php';

class DisplayEventController extends Controller
{
    public function get($request): void
    {
        $this->render('error', ["message" => "Méthode non prise en charge"]);
    }

    public function post($request): void
    {
        $EventsDAO = new EventsDAO();
        $UserDataDAO = new UserDataDAO();
        $AvailabilityDAO = new AvailabilityDAO();

        if (isset($request['event_id'])) {

            // Prendre les informations nécessaires sur l'événement, l'auteur, et les disponibilités
            $event = $EventsDAO->getEventById($request['event_id']);
            $author = $UserDataDAO->getUserById($event['user']);
            $availabilities = $AvailabilityDAO->getAvailabilityFromEvent($request['event_id']);

            $start_event_day = new DateTime($event['start']);
            $end_event_day = new DateTime($event['end']);
            $nbDaysEvent = $start_event_day->diff($end_event_day)->days;  // Nombre de jours dans l'événement
            $nbParticipants = $AvailabilityDAO->getNbPeopleAnswered($request['event_id'])['nbUser'];
            $availability_counts = [];
            for ($i = 8; $i < 24; $i++) {
                for ($j = 0; $j < $nbDaysEvent; $j++) {
                    $availability_counts[$i . '_' . $j] = 0;
                }
            }

            // Compte le nombre de personnes disponible pour chaque case
            foreach ($availabilities as $availability) {
                $availability_date = new DateTime($availability['start_time']); // Chaque disponibilité est un type DATETIME de MySQL

                // Décalage en jours par rapport à au début de l'événement (fait référence au $j ci-dessus)
                $day_offset = $start_event_day->diff($availability_date)->days;

                // Vérifie si la disponibilité tombe dans la plage de l'événement (sécurité)
                if ($day_offset >= 0 && $day_offset < $nbDaysEvent) {
                    $hour = (int)$availability_date->format('H'); // Heure en format 24h
                    $availability_counts[$hour . '_' . $day_offset]++;
                }
            }

            if (isset($_SESSION['user'])) {
                $userAlreadyAnswered = $AvailabilityDAO->didUserAnsweredYet($_SESSION['user'], $request['event_id']);
                $this->render('displayEvent', ['title' => $event['name'], 'description' => $event['description'], 'author' => $author['username'], 'availabilities' => $availability_counts, 'nbParticipants' => $nbParticipants, 'startDay' => $event['start'], 'nbDaysInEvent' => $nbDaysEvent, 'eventId' => $event['id'], 'userAlreadyAnswered' => $userAlreadyAnswered]);
            } else {
                $this->render('displayEvent', ['title' => $event['name'], 'description' => $event['description'], 'author' => $author['username'], 'availabilities' => $availability_counts, 'nbParticipants' => $nbParticipants, 'startDay' => $event['start'], 'nbDaysInEvent' => $nbDaysEvent, 'eventId' => $event['id']]);
            }
        } else {
            $this->render('error', ["message" => "Mauvaise requête lié à event_id"]);
        }
    }
}