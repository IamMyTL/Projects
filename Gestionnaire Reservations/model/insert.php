<?php

function insertEmploye($nom, $prenom, $mail, $cp, $locomotion, $departement, $souper){
    // Insérer un nouvel employé
    include('connexion.php');
    $query = "INSERT INTO employe (nom, prenom, mail, fk_cp, fk_locomotion, fk_departement, souper) VALUES(:nom, :prenom, :mail, :fk_cp, :fk_locomotion, :fk_departement, :souper)";
    $query_params = array(':nom'=>$nom, ':prenom'=>$prenom, ':mail'=>$mail, ':fk_cp'=>$cp, ':fk_locomotion'=>$locomotion, ':fk_departement'=>$departement, ':souper'=>$souper);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    return $db->lastInsertId();
}

function insertEmployeActivite($activite, $employe){
    // Insérer dans la table employe_activite
    include('connexion.php');
    $query = "INSERT INTO employe_activite (fk_activite, fk_employe) VALUES(:activite, :employe)";
    $query_params = array(':activite'=>$activite, ':employe'=>$employe);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}

function insertLoginAdmin($login, $mdp){
    // Insérer un nouvel admin
    include('connexion.php');
    $query = "INSERT INTO admin (login, password) VALUES(:login, :mdp)";
    $query_params = array(':login'=>$login, ':mdp'=>$mdp);
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