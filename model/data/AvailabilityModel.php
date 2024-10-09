<?php

namespace model\data;

class AvailabilityModel
{
    private $time;
    private $event;
    private $user;
    private $choice;

    public function __construct($time = null, $event = null, $user = null, $choice = null)
    {
        $this->time = $time;
        $this->event = $event;
        $this->user = $user;
        $this->choice = $choice;
    }

    // Getters and Setters
    public function getTime()
    {
        return $this->time;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getChoice()
    {
        return $this->choice;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setChoice($choice)
    {
        $this->choice = $choice;
    }
}

?>
