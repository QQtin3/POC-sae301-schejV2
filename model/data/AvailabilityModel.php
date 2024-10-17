<?php

namespace model\data;

class AvailabilityModel
{
    private $start_time;
    private $end_time;
    private $event;
    private $user;
    private $choice;

    public function __construct($event = null, $user = null, $choice = null, $start_time = null, $end_time = null)
    {
        $this->event = $event;
        $this->user = $user;
        $this->choice = $choice;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    // Getters and Setters
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
