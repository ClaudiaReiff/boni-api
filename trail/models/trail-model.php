<?php
class Trail {
    public $id;
    public $name;
    public $length;
    public $duration;
    public $description;
    public $altitude;
    public $checkpoints;

    public function __construct($id, $name,$length,$duration,$description,$altitude, $checkpoints) {
        $this->id = $id;
        $this->name = $name;
        $this->length = $length;
        $this->duration = $duration;
        $this->description = $description;
        $this->altitude = $altitude;
        $this->checkpoints = $checkpoints;
    }
}