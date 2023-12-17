<?php
session_start();
include("../model/function.php");
include("../model/insert.php");
include("../model/read.php");
$data = $_POST;
unset($_POST);


// htmlspecialchars et trim
foreach($data as &$value){
    $value = htmlspecialchars(trim($value));
}
$_SESSION["values"] = $data;


// Vérification des values des options si quelqu'un change les valeurs dans l'inspecteur.
foreach (array('cp', 'locomotion', 'departement', 'activite') as $i){
    if (!checkPk($data[$i], $_SESSION['elements'][$i])){
        unset($_SESSION['elements']);
        $_SESSION["error"]["triche"] = "True";
        header('Location: ..\view\formulaire.php');
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
$nbMax = (int)recupNbMax($data["activite"]);
$nbDePlacePrise = (int)recupNbDePlacePrise($data["activite"]);
if (recupNbMax($data["activite"]) != null && $nbDePlacePrise >= $nbMax){
    $_SESSION["error"]["nbmax"] = "True";
}


if (!isset($_SESSION["error"])){
    // Cette condition vérifie que personne portant le même nom et prénom existe déjà dans la db
    $nom = recupNom($data["prenom"]);
    if ($nom == $data["nom"]){
        $_SESSION["error"]["existe"] = "True";
        $url = 'Location: ..\view\formulaire.php';
    }else{
        // Ici on insert dans la table employé les données en résupérant la pk
        $last_id = insertEmploye($data["nom"], $data["prenom"], $data["mail"], $data["cp"], $data["locomotion"], $data["departement"], $souper);
        insertEmployeActivite($data["activite"], $last_id);
        unset($_SESSION["values"]);
        $url = 'Location: ..\view\ok.php';
    }
}else{
    $url = 'Location: ..\view\formulaire.php';
}

header($url);

?>