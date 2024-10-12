<?php

namespace model\dao;

use model\data\ChoicesModel;
use model\MySQLConnection;

require_once __ROOT__ . '/model/data/ChoicesModel.php';
require_once __ROOT__ . '/model/MySQLConnection.php';

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

    // Trouver un choix par ID
    public function getChoiceById($id)
    {
        $query = "SELECT * FROM choices WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Mettre à jour un choix
    public function updateChoice(ChoicesModel $choice)
    {
        $query = "UPDATE choices SET name = ?, event = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $name = $choice->getName();
        $event = $choice->getEvent();
        $id = $choice->getId();
        $stmt->bind_param("sii", $name, $event, $id);

        return $stmt->execute();
    }

    // Supprimer un choix
    public function deleteChoice($id)
    {
        $query = "DELETE FROM choices WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}


