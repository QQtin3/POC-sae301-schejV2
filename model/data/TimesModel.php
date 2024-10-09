<?php

namespace model\data;

class TimesModel
{
    private $id;
    private $startTime;
    private $endTime;
    private $event;

    public function __construct($id = null, $startTime = null, $endTime = null, $event = null)
    {
        $this->id = $id;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->event = $event;
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    public function setEvent($event)
    {
        $this->event = $event;
    }
}

?>
