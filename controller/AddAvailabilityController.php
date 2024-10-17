<?php

namespace controller;

require_once CONTROLLER_DIR . '/Controller.php';

class AddAvailabilityController extends Controller
{
    public function get($request): void
    {
        $this->render("addAvailability", ["message" => "Méthode GET non autorisée"]);
    }

    public function post($request): void {
        print_r($request);
        print_r($request['availability']);
    }
}