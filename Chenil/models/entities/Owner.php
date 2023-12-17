<?php

class Owner extends User {
    
    protected $id;
    protected $name;
    protected $firstname;
    protected $birthdate;
    protected $mail;
    protected $phone;
    protected $animals;
    protected $pass;
    protected static $dao_name = "OwnerDAO";
    
    public function __construct ($id, $name, $firstname, $birthdate, $mail, $phone, $pass, $animals) {
        $this->id = $id;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->birthdate = $birthdate;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->animals = $animals;
        parent::__construct($pass, self::$dao_name, "owner");
    }
    
    public function __toString () {
        return $this->name." ".$this->firstname;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            if ($prop == "animals"){
                return Animal::where("id_owner",$this->id);
            }
            return $this->$prop;
        }
    }
}

?>