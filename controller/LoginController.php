<?php

namespace controller;

use model\dao\UserDataDAO;
use model\data\UserDataModel;

require_once ROOT . '/model/data/UserDataModel.php';
require_once ROOT . '/model/dao/UserDataDAO.php';
require_once CONTROLLER_DIR . '/Controller.php';

class LoginController extends Controller
{
    public function get($request): void
    {
        $this->render("loginPage", []);
    }

    public function post($request): void
    {
        $dao = new UserDataDAO();
        $username = $request["username"];
        $password = $request["password"];

        // Retrieve user password & id
        $userIdAndPwd = $dao->retrievePwdWithUsername($username);
        if (isset($userIdAndPwd)) {
            $passwordInDatabase = $userIdAndPwd['password'];
            $userId = $userIdAndPwd['id'];
            $isPasswordValide = password_verify($password, $passwordInDatabase);  // Check if password is corresponding to hash in DB
            if ($isPasswordValide) {
                $userData = $dao->getUserById($userId);
                $_SESSION['user'] = $userId;  // Store connected user in session
                $_SESSION['username'] = $userData['username'];
                $this->render("index", ["popupConnected" => "true", "username" => $userData['username']]);
            } else {
                $this->render("loginPage", ["message" => "Le mot de passe ou le nom d'utilisateur n'est pas valide"]);
            }
        } else {
            $this->render("loginPage", ["message" => "Le mot de passe ou le nom d'utilisateur n'est pas valide"]);
        }
    }
}
