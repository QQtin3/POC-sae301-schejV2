<?php

namespace controller;

require_once CONTROLLER_DIR . '/Controller.php';

class MainController extends Controller {
    public function get($request): void
    {
        $this->render("index", []);
    }

    public function post($request): void
    {
        $this->render("index", []);
    }

}