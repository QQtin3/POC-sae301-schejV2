<?php

namespace controller;

require_once CONTROLLER_DIR . '/Controller.php';

class random extends Controller
{
    public function get($request): void
    {
        $this->render("info", []);
    }
}