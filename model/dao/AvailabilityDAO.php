<?php

namespace model\dao;

use model\data\AvailabilityModel;
use model\MySQLConnection;

require_once ROOT . '/model/data/AvailabilityModel.php';
require_once ROOT . '/model/MySQLConnection.php';

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
        $query = "INSERT INTO availability (event, user, choice, start_time, end_time, choiceValue) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $start_time = $availability->getStartTime();
        $end_time = $availability->getEndTime();
        $event = $availability->getEvent();
        $user = $availability->getUser();
        $choice = $availability->getChoice();
        $choiceValue = $availability->getChoiceValue();
        $stmt->bind_param("iiisss", $event, $user, $choice, $start_time, $end_time, $choiceValue);

        if ($stmt->execute()) {
            return $this->conn->insert_id;  // Retourne le dernier ID inséré
        } else {
            return false;
        }
    }

    // Trouver une disponibilité par événement et utilisateur
    public function getAvailabilityFromEvent($eventId)
    {
        $query = "SELECT * FROM availability WHERE event = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $availabilities = [];

            // Tous les résultats sont ajoutés
            while ($row = $result->fetch_assoc()) {
                $availabilities[] = $row;
            }
            return $availabilities;
        } else {
            return null;
        }
    }

    public function getNbPeopleAnswered($eventId)
    {
        $query = "SELECT COUNT(DISTINCT user) as nbUser FROM availability WHERE event = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function didUserAnsweredYet(int $id_user, int $id_event): ?bool
    {
        $query = "SELECT COUNT(DISTINCT user) as nbUser FROM availability WHERE event = ? AND user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $id_event, $id_user);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $array = $result->fetch_assoc();

            // Retourne true si l'utilisateur a déjà répondu
            return $array['nbUser'] > 0;
        } else {
            return null;
        }
    }
}
