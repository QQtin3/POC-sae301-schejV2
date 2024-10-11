<?php

namespace controller;

require_once CONTROLLER_DIR . '/Controller.php';

class CreateEventController extends Controller {

    public function get($request): void
    {
        if (isset($_SESSION['user'])) {
            $this->render("createEvent", []);
        }
    }

    public function post($request): void
    {

    }
}