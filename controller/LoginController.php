<?php

namespace controller;

use model\MySQLConnection;

require_once __ROOT__ . '/model/MySQLConnection.php';
require_once CONTROLLER_DIR . '/Controller.php';

class LoginController extends Controller
{
    public function get($request): void
    {
        $database = MySQLConnection::getInstance();
        echo "this is ok";
        $this->render("loginPage", []);
    }

    public function post($request): void
    {
        $username = $request["username"];
        $password = $request["password"];
        // Hash method : password.hash / password.valid

        $userID = 0;
        $_SESSION['user'] = $userID;
    }
}