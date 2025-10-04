<?php

namespace controller;

use model\dao\UserDataDAO;
use model\data\UserDataModel;

require_once ROOT . '/model/data/UserDataModel.php';
require_once ROOT . '/model/dao/UserDataDAO.php';
require_once CONTROLLER_DIR . '/Controller.php';

class RegisterController extends Controller
{
    public function get($request): void
    {
        $this->render("registerPage", []);
    }

    public function post($request): void
    {
        try {
            $userDAO = new UserDataDAO();
            $username = $request['username'];
            $password = $request['password'];
            $password_confirm = $request['confirm_password'];
            if (isset($username) && isset($password) && isset($password_confirm)) {
                if ($password != $password_confirm) {
                    $this->render("registerPage", ["message" => "Les mots de passe ne correspondent pas"]);
                } else {
                    // Some checks to make sure data is valid
                    if ($userDAO->isUsernameAlreadyInDB($username)) {
                        $this->render("registerPage", ["message" => "Ce nom d'utilisateur est déjà attribué"]);
                    } elseif (!UserDataDAO::isUsernameValid($username)) {
                        $this->render("registerPage", ["message" => "Ce nom d'utilisateur n'est pas valide (doit être supérieur ou égal à 3 caractères)"]);
                    } elseif (!UserDataDAO::isPasswordSecure($password)) {
                        $this->render("registerPage", ["message" => "Ce mot de passe n'est pas valide (doit être supérieur ou égal à 8 caractères)"]);
                    } else {
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $user = new UserDataModel(null, $username, $hashedPassword, null);
                        $isOperationComplete = $userDAO->createUser($user);
                        if ($isOperationComplete) {
                            $this->render("registerPage", ["username" => $username]);
                        } else {
                            $this->render("registerPage", ["message" => "L'opération n'a pas pu aboutir merci de réessayer"]);
                        }
                    }
                }
            }
        } catch (\Exception $exception) {
            print $exception;
            $this->render("error", ["message" => $exception->getMessage()]);
        }
    }
}
