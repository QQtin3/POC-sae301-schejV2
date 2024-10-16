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
            return $this->conn->insert_id;  // Retourne le dernier ID inséré
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

    public function isUsernameAlreadyInDB($username): bool
    {
        $query = "SELECT COUNT(*) AS nb FROM user_data WHERE username=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['nb'] > 0;
    }

    public function retrievePwdWithUsername($username)
    {
        try {
            $query = "SELECT id,password FROM user_data WHERE username=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $username);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $rows = $result->fetch_assoc();
                return $rows;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return null;
        }
    }

    public static function isPasswordSecure($password): bool
    {
        return strlen($password) >= 8;
    }
    public static function isUsernameValid($username): bool
    {
        return strlen($username) >= 3;
    }
}

?>
