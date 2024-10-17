<?php

namespace controller;

use model\dao\AvailabilityDAO;
use model\dao\EventsDAO;
use model\dao\UserDataDAO;

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

        $this->render('displayEvent', ["message" => "Méthode non prise en charge"]);


    }
}