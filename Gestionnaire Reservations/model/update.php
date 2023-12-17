<?php

function updateEmploye($pk, $nom, $prenom, $mail, $cp, $locomotion, $departement, $souper){
    include('connexion.php');
    $query = "UPDATE employe SET nom = :nom, prenom = :prenom, mail = :mail, fk_cp = :pk_cp, fk_locomotion = :pk_locomotion, fk_departement = :pk_departement, souper = :souper WHERE pk_employe = :pk_employe";
    $query_params = array(':nom'=>$nom, ':prenom'=>$prenom, ':mail'=>$mail, ':pk_cp'=>$cp, ':pk_locomotion'=>$locomotion, ':pk_departement'=>$departement, ':souper'=>$souper, ':pk_employe'=>$pk);
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
