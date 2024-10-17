<?php

namespace model\dao;

use model\data\EventsModel;
use model\MySQLConnection;

require_once __ROOT__ . '/model/data/EventsModel.php';
require_once __ROOT__ . '/model/MySQLConnection.php';

class EventsDAO {

    private $conn;

    public function __construct() {
        $this->conn = MySQLConnection::getInstance();
    }

    // Ajouter un événement
    public function createEvent(EventsModel $event) {
        $query = "INSERT INTO events (name, description, user, start, end) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $name = $event->getName();
        $desc = $event->getDescription();
        $user = $event->getUser();
        $start = $event->getStart();
        $end = $event->getEnd();
        $stmt->bind_param("ssiss", $name, $desc, $user, $start, $end);
        $result = $stmt->execute();
        if ($result) {
            return $this->conn->insert_id;  // Retourne le dernier ID inséré
        } else {
            return false;
        }
    }

    // Trouver un événement par ID
    public function getEventById($id) {
        $query = "SELECT * FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Trouver un événement par ID
    public function getEventByUserId($id) {
        $query = "SELECT * FROM events WHERE user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $events = [];

            // Tous les résultats sont ajoutés
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }

            return $events;
        } else {
            return null; // Echec de la requête
        }
    }

    // Mettre à jour un événement
    public function updateEvent(EventsModel $event) {
        $query = "UPDATE events SET name = ?, description = ?, user = ?, start = ?, end = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $name = $event->getName();
        $desc = $event->getDescription();
        $user = $event->getUser();
        $start = $event->getStart();
        $end = $event->getEnd();
        $id = $event->getId();
        $stmt->bind_param("ssissi", $name, $desc, $user, $start, $end, $id);

        return $stmt->execute();
    }

    // Supprimer un événement
    public function deleteEvent($id) {

        // D'abord supprimer les entrées contenant une référence vers l'événement dans les autres tables
        $this->deleteRelatedChoices($id);

        // Puis supprimer l'événement
        $query = "DELETE FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    // Fonction associée à deleteEvent
    private function deleteRelatedChoices($eventId) {
        $query = "DELETE FROM choices WHERE event = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $eventId);
        return $stmt->execute();
    }
}

?>
