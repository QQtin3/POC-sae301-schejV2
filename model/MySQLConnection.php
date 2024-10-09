<?php

namespace model;
require_once __ROOT__ . 'config.php';

use mysqli;

class MySQLConnection
{
    // Define constants
    t

    private static ?mysqli $instance = null;

    public static function getInstance(): mysqli
    {
        if (self::$instance === null) { // Check if instance is null
            // Create a new MySQLi connection
            self::$instance = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE);

            // Check connection
            if (self::$instance->connect_errno) {
                echo "Failed to connect to MySQL: " . self::$instance->connect_error;
                exit();
            }
        }
        return self::$instance;
    }
}
?>
