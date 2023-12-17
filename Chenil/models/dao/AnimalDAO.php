<?php

class AnimalDAO extends DAO {
    public function __construct () {
        parent::__construct("animals");
    }

    public function create ($data) {
        if ($data instanceof Animal) {
            return $data;
        }
        
        if (!is_object($data)) {
            return new Animal(
                isset($data['id']) ? $data['id'] : 0,
                $data['name'],
                $data['gender'],
                $data['birthdate'],
                $data['sterilized'],
                $data['chip_id'],
                $data['id_owner'],
                "Visits"
            );
        }
        return false;
    }

    public function store ($data , $statement = false) {
        $obj = $this->create($data);
        
        if (!$obj) {
            return false;
        }
        
        $statement = $this->db->prepare("INSERT INTO {$this->table} (name, gender, birthdate, sterilized, chip_id, id_owner) VALUES (?, ?, ?, ?, ?, ?)");
        parent::store([$obj->name, $obj->gender, $obj->birthdate, $obj->sterilized, $obj->chip_id, $obj->owner->id], $statement);
    }

    public function update ($data) {
        $obj = $this->create($data);

        if (!$obj) {
            return false;
        }

        $statement = $this->db->prepare("UPDATE {$this->table} SET name=?, gender=?, birthdate=?, sterilized=?, chip_id=? WHERE id=?");
        try {
            $statement->execute([$obj->name, $obj->gender, $obj->birthdate, $obj->sterilized, $obj->chip_id, $obj->id]);
            return true;
            
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
}

?>