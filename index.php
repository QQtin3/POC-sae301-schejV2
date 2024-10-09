<?php
const __ROOT__ = __DIR__;
// Configuration
require_once __ROOT__ . "/config.php";

session_start();

if (DEBUG) {
    ini_set("display_errors", "On");
    error_reporting(E_ALL);
}
// ApplicationController
require_once CONTROLLER_DIR . "/ApplicationController.php";

use controller\ApplicationController;

// Add routes here
ApplicationController::getInstance()->addRoute(
    "/",
    CONTROLLER_DIR . "/random.php"
);

ApplicationController::getInstance()->addRoute(
    "register",
    CONTROLLER_DIR . "/RegisterController.php"
);

// Process the request
ApplicationController::getInstance()->process();
?>
