<?php

class OwnerDAO extends DAO {
    public function __construct () {
        parent::__construct("owners");
    }

    public function create ($data) {
        if ($data instanceof Owner) {
            return $data;
        }
        
        if (!is_object($data)) {
            return new Owner(
                isset($data['id']) ? $data['id'] : 0,
                $data['name'],
                $data['firstname'],
                $data['birthdate'],
                $data['mail'],
                $data['phone'],
                $data['pass'],
                "Animals"
            );
        }
        return false;
    }

    public function store ($data , $statement = false) {
        $obj = $this->create($data);
        
        if (!$obj) {
            return false;
        }
        
        $statement = $this->db->prepare("INSERT INTO {$this->table} (name, firstname, birthdate, mail, phone, pass) VALUES (?, ?, ?, ?, ?, ?)");
        parent::store([$obj->name, $obj->firstname, $obj->birthdate, $obj->mail, $obj->phone, $obj->pass], $statement);
    }

    public function update ($data) {
        $obj = $this->create($data);

        if (!$obj) {
            return false;
        }

        $statement = $this->db->prepare("UPDATE {$this->table} SET name=?, firstname=?, birthdate=?, mail=?, phone=?, pass=? WHERE id=?");
        try {
            $statement->execute([$obj->name, $obj->firstname, $obj->birthdate, $obj->mail, $obj->phone, $obj->pass, $obj->id]);
            return true;
            
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
}

?>