<?php
interface EntityInterface {
    
    /*Gestion de l'entité*/
    /*Doit permettre à l'entité de communiquer avec son DAO pour qu'elle se sauvegarde en persistance*/
    public function save ();
    
    /*Doit permettre à l'entité de communiquer avec son DAO pour qu'elle se supprime en persistance*/
    public function delete();
    
    
    /*Gestion de recherche d'entités*/
    /*Doit permettre de trouver et d'instancier une entité avec l'id = $id*/
    public static function find($id);
    
    /*Doit permettre de retourner un tableau contenant toutes les entités de ce type*/
    public static function all();
    
    /*Doit permettre de retourner un tableau contenant toutes les entités de ce type ou $attr = $value*/
    public static function where($attr, $value);
    
    /*Doit permettre de retourner la première entité de ce type ou $attr = $value*/
    public static function first($attr, $value);
}