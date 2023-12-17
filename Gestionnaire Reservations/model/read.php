<?php
function recupInfo($pk){
    // Return toutes les infos de la pk.
    include('connexion.php');
    $query = "SELECT * FROM employe WHERE pk_employe = :pk";
    $query_params = array(":pk" => $pk);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0];
}

function recupAllInfo($tb){
    // Return toute la table de la table donnée
    include('connexion.php');
    $query = "SELECT * FROM ".$tb;
    $query_params = array();
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return (!empty($result)) ? $result: 'NULL';
}

function recupNom($prenom){
    // Return le nom associé au prénom donné
    include('connexion.php');
    $query = "SELECT nom FROM employe WHERE prenom = :prenom";
    $query_params = array(":prenom" => $prenom);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]['nom'];
}

function recupNbMax($pk_activite){
    // Return le nombre max qu'une activitée peut avoir
    include('connexion.php');
    $query = "SELECT nbmax FROM activite WHERE pk_activite = :activite";
    $query_params = array(":activite" => $pk_activite);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]["nbmax"];
}

function recupNbDePlacePrise($pk_activite){
    // Return le nombre de personne étant inscrit à une activitée
    include('connexion.php');
    $query = "SELECT COUNT(*) FROM employe_activite INNER JOIN activite ON fk_activite = pk_activite WHERE pk_activite = :activite";
    $query_params = array(":activite" => $pk_activite);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]["COUNT(*)"];
}

function recupAllLogin(){
    // Return tout les login de la table admin
    include('connexion.php');
    $query = "SELECT login FROM admin";
    $query_params = array();
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return (!empty($result)) ? $result: 'NULL';
}

function recupMdp($login){
    // Return le mot de passe d'un login
    include('connexion.php');
    $query = "SELECT password from admin WHERE login = :login";
    $query_params = array(":login" => $login);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]["password"];
}

function recupFromFk($tb, $fk, $column){
    // Return les données d'une colonne choisie.
    include('connexion.php');
    $query = "SELECT ".$tb.".".$column." FROM ".$tb." INNER JOIN employe ON pk_".$tb." = fk_".$tb." WHERE pk_".$tb." = ".$fk;
    $query_params = array();
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0][$column];
}

function recupActivite($pk){
    // Return la fk_activité d'un employé.
    include('connexion.php');
    $query = "SELECT fk_activite FROM employe_activite WHERE fk_employe = :pk";
    $query_params = array(":pk" => $pk);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]["fk_activite"];
}

function recupEmployeActivity($activity){
    // Return le nom et prénom des employé qui participent à une activitée donnée en paramètre
    include('connexion.php');
    $query = "SELECT nom, prenom FROM employe INNER JOIN employe_activite ON pk_employe = fk_employe WHERE fk_activite = :activity";
    $query_params = array(":activity" => $activity);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    return (!empty($result)) ? $result: 'NULL';
}

function recupAllPkActivite(){
    // Return les noms de toutes les activitées.
    include('connexion.php');
    $query = "SELECT pk_activite FROM activite";
    $query_params = array();
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result;
}

function recupNomActivite($pk){
    // Return le nom d'une activitée
    include('connexion.php');
    $query = "SELECT nom FROM activite WHERE pk_activite = :pk";
    $query_params = array(":pk"=>$pk);
    try
    {
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
    $result = $stmt->fetchall();
    if (empty($result)){
        return false;
    }
    return $result[0]["nom"];
}
?>