<?php

interface DAOInterface {
    /*Retourne une instance de l'entité correspondante à ce DAO*/
    public function create($data);
    
    /*Retourne l'entité ou id=$id*/
    public function fetch($id);
    
    /*Retourne les entités ou $attr = $value*/
    public function where($attr, $value);
    
    /*Retourne la première entité ou $attr = $value*/
    public function first($attr, $value);
    
    /*Retourne une liste d'entité*/
    public function fetch_all();
    
    /*Sauvegarde une entité*/
    public function store($obj, $stmnt = false);
    
    /*Supprime une entité*/
    public function destroy($obj);
}