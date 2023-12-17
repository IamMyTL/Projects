<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Animal extends Entity {
    
    protected $id;
    protected $name;
    protected $gender;
    protected $birthdate;
    protected $sterilized;
    protected $chip_id;
    protected $owner;
    protected $visits;
    protected static $dao_name = "AnimalDAO";
    
    public function __construct ($id, $name, $gender, $birthdate, $sterilized, $chip_id, $owner, $visits) {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->sterilized = $sterilized;
        $this->chip_id = $chip_id;
        $this->owner = $owner;
        $this->visits = $visits;
        parent::__construct(self::$dao_name);
    }
    
    public function __toString () {
        return $this->name;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "owner"){
                return Owner::find($this->owner);
            }
            if ($prop == "visits"){
                return Visit::where("id_animal", $this->id);
            }
            return $this->$prop;
        }
    }

    public function addNewAnimal(){
        if (filter_var($this->chip_id, FILTER_VALIDATE_INT) === false){
            return false;
        }
        if (strlen($this->chip_id) < 0 || strlen($this->chip_id) > 10){
            return false;
        }

        $checkChipId = Animal::first("chip_id", $this->chip_id);
        if ($this->id == false){    // Si c'est un nouvel ajout
            if ($checkChipId){
                return false;
            }
        }
    
        if ($this->gender != "F"
        && $this->gender != "M"
        && $this->sterilized != "0"
        && $this->sterilized != "1")
        {
            return false;
        }
        $this->save();
        return true;
    }
}

?>