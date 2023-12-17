<?php

class Visit extends Entity {
    
    protected $id;
    protected $date;
    protected $animal;
    protected $rate;
    protected $maxPlace;
    protected static $dao_name = "VisitDAO";
    
    public function __construct ($id, $date, $animal, $rate, $maxPlace=false) {
        $this->id = $id;
        $this->date = $date;
        $this->animal = $animal;
        $this->maxPlace = $maxPlace ? $maxPlace : 5;
        $this->rate = $rate;
        parent::__construct(self::$dao_name);
    }
    
    public function __toString () {
        return $this->id;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "animal"){
                return Animal::find($this->animal);
            }
            elseif ($prop == "rate") {
                return self::occupancyRate();
            }
            return $this->$prop;
        }
    }

    public function occupancyRate(){
        //$maxPlace = 5;
        $count = (new VisitDAO())->countPerDate($this->date);
        return $count["COUNT(*)"]/$this->maxPlace;
    }

    public function addNewVisit(){
        $checkDate = (new VisitDAO)->checkAnimalDate("visit_date", "id_animal", $this->date, $this->animal); // On vérifie les doublons de date
        if ($checkDate){  
            return false;
        }

        // $count = (new VisitDAO())->countPerDate($this->date);
        // if ($count >= $this->maxplace){
        //     return false;
        // }

        $this->save();
        return true;
    }
}

?>