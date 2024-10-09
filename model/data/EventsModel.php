<?php

namespace model\data;

class EventsModel
{
    private $id;
    private $name;
    private $description;
    private $user;
    private $start;
    private $end;

    public function __construct($id = null, $name = null, $description = null, $user = null, $start = null, $end = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->user = $user;
        $this->start = $start;
        $this->end = $end;
    }

    // Getters and Setters as needed
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setStart($start)
    {
        $this->start = $start;
    }

    public function setEnd($end)
    {
        $this->end = $end;
    }
}
