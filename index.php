<?php
const ROOT = __DIR__;
// Configuration
require_once ROOT . "/config.php";

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
    CONTROLLER_DIR . "/MainController.php"
);

ApplicationController::getInstance()->addRoute(
    "register",
    CONTROLLER_DIR . "/RegisterController.php"
);

ApplicationController::getInstance()->addRoute(
    "connect",
    CONTROLLER_DIR . "/LoginController.php"
);

ApplicationController::getInstance()->addRoute(
    "disconnect",
    CONTROLLER_DIR . "/DisconnectController.php"
);

ApplicationController::getInstance()->addRoute(
    "create",
    CONTROLLER_DIR . "/CreateEventController.php"
);

ApplicationController::getInstance()->addRoute(
    "search",
    CONTROLLER_DIR . "/SearchEventController.php"
);

ApplicationController::getInstance()->addRoute(
    "add_availability",
    CONTROLLER_DIR . "/AddAvailabilityController.php"
);

ApplicationController::getInstance()->addRoute(
    "display",
    CONTROLLER_DIR . "/DisplayEventController.php"
);

ApplicationController::getInstance()->addRoute(
    "delete",
    CONTROLLER_DIR . "/DeleteEventController.php"
);


// Process the request
ApplicationController::getInstance()->process();
