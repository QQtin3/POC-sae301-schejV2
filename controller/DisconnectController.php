<?php

namespace controller;

require_once CONTROLLER_DIR . "/Controller.php";

class DisconnectController extends Controller
{
    public function get($request): void
    {
        if (isset($_SESSION['user'])) {
            $this->render("disconnect", []);
        } else {
            $this->render("error", ["message" => "Vous ne pouvez pas vous déconnecter car vous n'êtes déjà pas connecté !"]);
        }

    }

    public function post($request): void
    {
        if (isset($_SESSION)) {
            session_destroy();
            $this->render("disconnect", ["isDisconnected" => true]);
        } else {
            $this->render("error", ["message" => "Vous ne pouvez pas vous déconnecter car vous n'êtes déjà pas connecté !"]);
        }

    }
}
