<?php

namespace controller;

use DateTime;
use model\dao\AvailabilityDAO;
use model\dao\EventsDAO;
use model\dao\UserDataDAO;
use model\data\AvailabilityModel;

require_once __ROOT__ . "/model/dao/EventsDAO.php";
require_once __ROOT__ . "/model/dao/UserDataDAO.php";
require_once __ROOT__ . "/model/dao/AvailabilityDAO.php";
require_once CONTROLLER_DIR . '/Controller.php';

class AddAvailabilityController extends Controller
{
    public function get($request): void
    {
        $this->render("addAvailability", ["message" => "Méthode GET non autorisée"]);
    }

    public function post($request): void
    {
        if (isset($_SESSION['user'])) {
            if (isset($request['wannaAdd'])) {
                $EventsDAO = new EventsDAO();
                $UserDataDAO = new UserDataDAO();

                // Prendre les informations nécessaires sur l'événement, l'auteur, et les disponibilités
                $event = $EventsDAO->getEventById($request['eventId']);
                $author = $UserDataDAO->getUserById($event['user']);
                $start_event_day = new DateTime($event['start']);
                $end_event_day = new DateTime($event['end']);
                $nbDaysEvent = $start_event_day->diff($end_event_day)->days;  // Nombre de jours dans l'événement

                $this->render('addAvailability', ['title' => $event['name'], 'description' => $event['description'], 'author' => $author['username'], 'eventId' => $event['id'], 'nbDaysInEvent' => $nbDaysEvent, 'startDay' => $event['start']]);
            } else {
                $EventsDAO = new EventsDAO();
                $AvailabilityDAO = new AvailabilityDAO();

                $event = $EventsDAO->getEventById($request['eventId']);
                $start_day = new DateTime($event['start']);

                foreach (json_decode($request['selected_availabilities'], true) as $availability) {
                    $arr = explode("_", $availability);

                    $heure_debut_digits = $arr[0];  // Chiffres de l'heure
                    if (strlen($heure_debut_digits) == 1) {
                        $heure_debut_digits = "0" . $heure_debut_digits;  // Rajoute un 0 devant si composé que d'un chiffre (ex: 9h)
                    }


                    $modified_date = $start_day->modify("+ {$arr[1]} day");
                    $formated_date = $modified_date->format('Y-m-d');
                    $heure_debut = $heure_debut_digits . ":00";

                    // On ne peut pas arriver à 24h, mais à minuit à la place
                    if ($heure_debut_digits + 1 == 24) {
                        $heure_fin = "00:00";
                    } else {
                        $heure_fin = $heure_debut_digits + 1 . ":00";
                    }

                    $value = "true";  // Valeur par rapport au choix

                    $model = new AvailabilityModel($request['eventId'], $_SESSION['user'], 1, $formated_date . " " . $heure_debut, $formated_date . " " . $heure_fin, $value);
                    $AvailabilityDAO->createAvailability($model);
                }
                $this->render('index', ["message" => "Votre disponibilité a bien été ajoutée"]);

            }
        } else {
            $this->render('error', ['message' => 'Vous devez être connecté pour ajouter des disponibilités !']);
        }
    }
}