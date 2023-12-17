<?php

class Admin extends User {
    protected $id;
    protected $username;
    protected $pass;
    protected static $dao_name = "AdminDAO";

    public function __construct ($id, $username, $pass){
        $this->id = $id;
        $this->username = $username;
        parent::__construct($pass, self::$dao_name, "admin");
    }

    public function __get($prop){
        if (property_exists($this, $prop)){
            return $this->$prop;
        }
    }
}

?>