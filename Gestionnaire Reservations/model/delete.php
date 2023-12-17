<?php

function deleteEmployeChild($pk){
    include('connexion.php');
    $query = "DELETE FROM employe_activite WHERE fk_employe = :pk";
    $query_params = array(':pk' => $pk);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}

function deleteEmploye($pk){
    include('connexion.php');
    $query = "DELETE FROM employe WHERE pk_employe = :pk";
    $query_params = array(':pk' => $pk);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}

?>