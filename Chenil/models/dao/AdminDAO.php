<?php

class AdminDAO extends DAO {
    public function __construct() {
        parent::__construct("admins");
    }

    public function create ($data) {
        if ($data instanceof Admin) {
            return $data;
        }
        
        if (!is_object($data)) {
            return new Admin(
                isset($data['id']) ? $data['id'] : 0,
                $data['usernname'],
                $data['pass']
            );
        }
        return false;
    }

    public function store ($data , $statement = false) {
        $obj = $this->create($data);
        
        if (!$obj) {
            return false;
        }
        
        $statement = $this->db->prepare("INSERT INTO {$this->table} (username, pass) VALUES (?, ?)");
        parent::store([$obj->username, $obj->pass], $statement);
    }
}

?>