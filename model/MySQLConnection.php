<?php

namespace model;
require_once __ROOT__ . '/config.php';

use mysqli;

class MySQLConnection
{
    private static ?mysqli $instance = null;

    public static function getInstance(): mysqli
    {
        if (self::$instance === null) { // Check if instance is null
            // Create a new MySQLi connection using config file (so make sure it is setup correctly)
            self::$instance = new mysqli(HOST, USER, PASSWORD, DATABASE);

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
