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
}
