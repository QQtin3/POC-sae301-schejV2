<?php

namespace model\data;


class ChoicesModel
{
    private $id;
    private $name;
    private $event;

    public function __construct($id = null, $name = null, $event = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->event = $event;
    }

    // Getters and Setters
    public function getName()
    {
        return $this->name;
    }

    public function getEvent()
    {
        return $this->event;
    }
}

?>
