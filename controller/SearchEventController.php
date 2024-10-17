<?php

namespace controller;

use model\dao\EventsDAO;
use model\dao\UserDataDAO;

require_once __ROOT__ . "/model/dao/EventsDAO.php";
require_once __ROOT__ . "/model/dao/UserDataDAO.php";
require_once CONTROLLER_DIR . '/Controller.php';

class SearchEventController extends Controller
{
    public function get($request): void
    {
        $this->render("search", []);
    }

    public function post($request): void
    {
        if (isset($request['event_id'])) {
            $eventID = $request['event_id'];
            if ($eventID < 0) {
                $this->render("search", ["message" => "Veuillez saisir un identifiant d'évènement valide (doit être positif)"]);
            } else {
                $eventsDAO = new EventsDAO();
                $userDataDAO = new UserDataDAO();
                $event = $eventsDAO->getEventById($eventID);
                if (isset($event)) {  // S'assure que l'indice soit bon et qu'on obtient bien des valeurs
                    $user = $userDataDAO->getUserById($event['user']);
                    $this->render("search", ["id" => $event['id'], "title" => $event['name'],
                        "description" => $event['description'],
                        "createdBy" => $user['username'], "end" => $event['end']]);
                } else {
                    $this->render("search", ["message" => "L'identifiant doit être valide"]);
                }
            }
        } else {
            $this->render("search", ["message" => "Une erreur s'est produite veuillez réessayer"]);
        }
    }
}

?>