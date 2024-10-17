<?php

namespace controller;

use model\dao\EventsDAO;

require_once CONTROLLER_DIR . "/Controller.php";
require_once __ROOT__ . "/model/dao/EventsDAO.php";

class DeleteEventController extends Controller
{
    public function get($request): void
    {
       $this->render('error', ["message" => "Méthode GET non autorisée"]);
    }

    public function post($request): void
    {
        if (isset($_SESSION['user'])) {  // L'utilisateur doit être connecté pour supprimer un de ses événements
            $eventDAO = new EventsDAO();
            $eventOwner = $eventDAO->getEventById($request['event_id'])['user'];
            if ($_SESSION['user'] == $eventOwner) {  // Sécurité, l'utilisateur connecté doit être le créateur de l'événement à supprimer
                $eventDAO->deleteEvent($request['event_id']);
                $events = $eventDAO->getEventByUserId($_SESSION['user']);  // On repasse les événements dans la vue
                $this->render('index', ["message" => "L événement a bien été supprimé", "events" => $events]);
            } else {
                $this->render('error', ["message" => "Vous n'êtes pas le propriétaire de cet événement"]);
            }
        } else {
            $this->render('error', ["message" => "Vous devez être connecté afin de réaliser cette opération"]);
        }
    }
}