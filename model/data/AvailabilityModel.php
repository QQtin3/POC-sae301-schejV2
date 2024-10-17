<?php

namespace model\data;

class AvailabilityModel
{
    private $start_time;
    private $end_time;
    private $event;
    private $user;
    private $choice;
    private $choiceValue;

    public function __construct($event = null, $user = null, $choice = null, $start_time = null, $end_time = null, $choiceValue = null)
    {
        $this->event = $event;
        $this->user = $user;
        $this->choice = $choice;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->choiceValue = $choiceValue;
    }

    // Getters and Setters
    public function getEvent()
    {
        return $this->event;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getChoiceValue()
    {
        return $this->choiceValue;
    }

    public function getChoice()
    {
        return $this->choice;
    }
}

?>
