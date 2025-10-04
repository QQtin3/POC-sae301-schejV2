<?php

namespace model\data;

class UserDataModel
{
    private $id;
    private $username;
    private $password;
    private $createdAt;

    public function __construct($id = null, $username = null, $password = null, $createdAt = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
