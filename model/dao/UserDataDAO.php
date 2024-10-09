<?php

namespace model\dao;

use model\data\UserDataModel;
use model\MySQLConnection;

require_once __ROOT__ . '/model/data/UserDataModel.php';
require_once __ROOT__ . '/model/MySQLConnection.php';

class UserDataDAO
{

    private $conn;

    public function __construct()
    {
        $this->conn = MySQLConnection::getInstance();;
    }

    // Ajouter un utilisateur
    public function createUser(UserDataModel $userData): bool
    {
        $query = "INSERT INTO user_data (username, password, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($query);

        $username = $userData->getUsername();
        $password = $userData->getPassword();

        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Trouver un utilisateur par ID
    public function getUserById($id)
    {
        $query = "SELECT * FROM user_data WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Mettre à jour un utilisateur
    public function updateUser(UserDataModel $userData): bool
    {
        $query = "UPDATE user_data SET username = ?, password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $username = $userData->getUsername();
        $password = $userData->getPassword();
        $id = $userData->getId();
        $stmt->bind_param("ssi", $username, $password, $id);

        return $stmt->execute();
    }

    // Supprimer un utilisateur
    public function deleteUser($id): bool
    {
        $query = "DELETE FROM user_data WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}

?>
