<?php

class VisitDAO extends DAO {
    public function __construct () {
        parent::__construct("visits");
    }

    public function create ($data) {
        if ($data instanceof Visit) {
            return $data;
        }
        
        if (!is_object($data)) {
            return new Visit(
                isset($data['id']) ? $data['id'] : 0,
                $data['visit_date'],
                $data['id_animal'],
                false,
                false
            );
        }
        return false;
    }

    public function store ($data , $statement = false) {
        $obj = $this->create($data);
        
        if (!$obj) {
            return false;
        }
        
        $statement = $this->db->prepare("INSERT INTO {$this->table} (visit_date, id_animal) VALUES (?, ?)");
        parent::store([$obj->date, $obj->animal->id], $statement);
    }

    public function countPerDate($date){
        $statement = $this->db->prepare("SELECT COUNT(*) FROM {$this->table} WHERE visit_date = ?");
        try {
            $statement->execute([$date]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result;
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function checkAnimalDate ($date, $id_animal, $date_value, $id_animal_value) {
        // Vérifie si un animal a déjà un séjour à une certaine date
        $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$date}=? AND {$id_animal}=?");
        try {
            $statement->execute([$date_value, $id_animal_value]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $this->create($result);
            }
            return false;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
}

?>