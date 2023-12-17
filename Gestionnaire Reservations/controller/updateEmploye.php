<?php
session_start();
include("../model/function.php");
include("../model/update.php");
include("../model/read.php");
include("../model/insert.php");
include("../model/delete.php");

$data = $_POST;
unset($_POST);

// htmlspecialchars et trim
foreach($data as &$value){
    $value = htmlspecialchars(trim($value));
}

// Vérification des values des options si quelqu'un change les valeurs dans l'inspecteur.
foreach (array('cp', 'locomotion', 'departement', 'activite') as $i){
    if (!checkPk($data[$i], $_SESSION['elements'][$i])){
        unset($_SESSION['elements']);
        $_SESSION["error"]["triche2"] = "True";
        header('Location: ..\view\updateEmploye.php');
        exit();
    }
}
unset($_SESSION['elements']);

// Vérification si les input sont vides
foreach($data as $key => $value2){        // $key => 'activite', 'departement', ... $value => les valeurs
    $a = checkInput($value2);
    if (!$a){
        $_SESSION["error"][$key] = $key;
    }
}

// Vérification du mail
if(!filter_var($data["mail"], FILTER_VALIDATE_EMAIL)){
    $_SESSION["error"]["mail"] = "mail";
}

// Vérification du souper
if (isset($data["souper"])){
    $souper = "Oui";
}else{
    $souper = "Non";
}

// Vérification du nombre de place restant au cas où quelqu'un modifie le disabled dans l'inspecteur
if (recupNbMax($data["activite"]) != null && $nbDePlacePrise >= $nbMax){
    $nbMax = (int)recupNbMax($data["activite"]);
    $nbDePlacePrise = (int)recupNbDePlacePrise($data["activite"]);
    if ($nbDePlacePrise >= $nbMax){
        $_SESSION["error"]["nbmax"] = "True";
    }
}


if (!isset($_SESSION["error"])){
    // Ici on vérifie si l'utilisateur modifie ou pas le nom ou le prénom
    if ($_SESSION["last_name_employe"] != $data["nom"] || $_SESSION["last_firstname_employe"] != $data["prenom"]){
        // Cette condition vérifie que personne portant le même nom et prénom existe déjà dans la db
        $nom = recupNom($data["prenom"]);
        if ($nom == $data["nom"]){
            $_SESSION["error"]["existe"] = "True";
            header('Location: ..\view\updateEmploye.php');
            exit();
        }
    }
    // Update
    deleteEmployeChild($_SESSION["pk_updateEmploye"]);
    updateEmploye($_SESSION["pk_updateEmploye"], $data["nom"], $data["prenom"], $data["mail"], $data["cp"], $data["locomotion"], $data["departement"], $souper);
    insertEmployeActivite($data["activite"], $_SESSION["pk_updateEmploye"]);
    $url = 'Location: ..\view\adminpage.php';
    unset($_SESSION["pk_updateEmploye"]);
    
}else{
    $url = 'Location: ..\view\updateEmploye.php';
}

header($url);
?>