<?php

namespace model\dao;

use model\data\AvailabilityModel;
use model\MySQLConnection;

require_once __ROOT__ . '/model/data/AvailabilityModel.php';
require_once __ROOT__ . '/model/MySQLConnection.php';

class AvailabilityDAO
{

    private $conn;

    public function __construct()
    {
        $this->conn = MySQLConnection::getInstance();
    }

    // Ajouter une disponibilité
    public function createAvailability(AvailabilityModel $availability)
    {
        $query = "INSERT INTO availability (time, event, user, choice) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $time = $availability->getTime();
        $event = $availability->getEvent();
        $user = $availability->getUser();
        $choice = $availability->getChoice();
        $stmt->bind_param("iiii", $time, $event, $user, $choice);

        if ($stmt->execute()) {
            return $this->conn->insert_id;  // Retourne le dernier ID inséré
        } else {
            return false;
        }
    }

    // Trouver une disponibilité par événement et utilisateur
    public function getAvailability($event, $user)
    {
        $query = "SELECT * FROM availability WHERE event = ? AND user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $event, $user);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Mettre à jour une disponibilité
    public function updateAvailability(AvailabilityModel $availability)
    {
        $query = "UPDATE availability SET time = ?, choice = ? WHERE event = ? AND user = ?";
        $stmt = $this->conn->prepare($query);

        $time = $availability->getTime();
        $event = $availability->getEvent();
        $user = $availability->getUser();
        $choice = $availability->getChoice();
        $stmt->bind_param("iiii", $time, $choice, $event, $user);

        return $stmt->execute();
    }

    // Supprimer une disponibilité
    public function deleteAvailability($event, $user): bool
    {
        $query = "DELETE FROM availability WHERE event = ? AND user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $event, $user);

        return $stmt->execute();
    }
}

?>
