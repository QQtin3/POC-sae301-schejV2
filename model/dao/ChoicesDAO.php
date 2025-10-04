<?php

namespace model\dao;

use model\data\ChoicesModel;
use model\MySQLConnection;

require_once ROOT . '/model/data/ChoicesModel.php';
require_once ROOT . '/model/MySQLConnection.php';

class ChoicesDAO
{

    private $conn;

    public function __construct()
    {
        $this->conn = MySQLConnection::getInstance();
    }

    // Ajouter un choix
    public function createChoice(ChoicesModel $choice)
    {
        $query = "INSERT INTO choices (name, event) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);

        $name = $choice->getName();
        $event = $choice->getEvent();
        $stmt->bind_param("si", $name, $event);

        if ($stmt->execute()) {
            return $this->conn->insert_id;  // Retourne le dernier ID inséré
        } else {
            return false;
        }
    }
}


