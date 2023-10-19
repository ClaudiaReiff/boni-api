<?php
class Checkpoint {
    public $id;
    public $longitude;
    public $latitude;
    public $trailId;
    public $checkedIn;

    
    public function __construct($id, $longitude,$latitude,$trailId,$checkedIn) {
        $this->id = $id;
        $this->longitude = $longitude;
        $this->laltitude = $latitude;
        $this->trailId = $trailId;
        $this->checkedIn = $checkedIn;
    }
}