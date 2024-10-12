<?php

namespace controller;

use model\dao\ChoicesDAO;
use model\dao\EventsDAO;
use model\data\ChoicesModel;
use model\data\EventsModel;

require_once __ROOT__ . "/model/dao/ChoicesDAO.php";
require_once __ROOT__ . "/model/dao/EventsDAO.php";
require_once CONTROLLER_DIR . '/Controller.php';

class CreateEventController extends Controller
{

    public function get($request): void
    {
        if (isset($_SESSION['user'])) {
            $this->render("createEvent", []);
        } else {
            $this->render("createEvent", ["isNotConnected"]);
        }
    }

    public function post($request): void
    {
        if (isset($_SESSION['user'])) {
            try {
                $eventsDAO = new EventsDAO();
                $choicesDAO = new ChoicesDAO();

                $title = $request['title'];
                $description = $request['description'];
                $start_time = $request['start_date'];
                $end_time = $request['end_date'];
                $user = $_SESSION['user'];  // UserID

                $eventModel = new EventsModel(null, $title, $description, $user, $start_time, $end_time);
                $eventID = $eventsDAO->createEvent($eventModel);

                // Ajoute le choix "default" qui symbolise la présence ou non
                $choiceModel = new ChoicesModel(null, "default", $eventID);
                $choicesDAO->createChoice($choiceModel);

                if (isset($request['choices'])) {
                    $choicesList = $request['choices'];  // La liste de tous les choix supplémentaires
                    foreach ($choicesList as $choice) {
                        $choiceModel = new ChoicesModel(null, $choice, $eventID);
                        $choicesDAO->createChoice($choiceModel);
                    }
                }
                $this->render('createEvent', ["dataInserted" => "true"]);  // Renvoie sur la page avec une notification d'ajout des données

            } catch
            (\Exception $exception) {
                $this->render("error", ["message" => $exception->getMessage()]);
            }
        } else {
            $this->render("createEvent", ["isNotConnected" => "true"]);
        }
    }
}