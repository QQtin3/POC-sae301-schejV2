<?php

namespace controller;

use model\dao\EventsDAO;

require_once CONTROLLER_DIR . '/Controller.php';
require_once ROOT . "/model/dao/EventsDAO.php";

class MainController extends Controller
{
    public function get($request): void
    {
        if (!isset($_SESSION['user'])) {
            $this->render("index", []);
        } else {
            $eventsDAO = new EventsDAO();
            $events = $eventsDAO->getEventByUserId($_SESSION['user']);
            if ($events === null || count($events) === 0) {
                $this->render("index", []);
            } else {
                $this->render("index", ["events" => $events]);  // Renvoie avec les événements créés par l'utilisateur
            }
        }
    }

    public function post($request): void
    {
        $this->render("error", ["message" => "Méthode POST non autorisée pour index.php"]);
    }
}
