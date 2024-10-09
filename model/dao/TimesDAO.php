<?php

namespace model\dao;

use model\data\TimesModel;
use model\MySQLConnection;

require_once __ROOT__ . '/model/data/TimesModel.php';
require_once __ROOT__ . '/model/MySQLConnection.php';

class TimesDAO {

    private $conn;

    public function __construct() {
        $this->conn = MySQLConnection::getInstance();
    }

    // Ajouter une plage horaire
    public function createTime(TimesModel $time) {
        $query = "INSERT INTO times (start_time, end_time, event) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $start = $time->getStartTime();
        $end = $time->getEndTime();
        $event = $time->getEvent();

        $stmt->bind_param("ssi", $start, $end, $event);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Trouver une plage horaire par ID
    public function getTimeById($id) {
        $query = "SELECT * FROM times WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Mettre à jour une plage horaire
    public function updateTime(TimesModel $time) {
        $query = "UPDATE times SET start_time = ?, end_time = ?, event = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $start = $time->getStartTime();
        $end = $time->getEndTime();
        $event = $time->getEvent();
        $id = $time->getId();

        $stmt->bind_param("ssii", $start, $end, $event, $id);

        return $stmt->execute();
    }

    // Supprimer une plage horaire
    public function deleteTime($id) {
        $query = "DELETE FROM times WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>
