<?php

function checkInput($entry){
    // Vérifie que l'input n'est pas vide
    if (strlen($entry) == 0){
        return false;
    }
    return true;
}


function showError($name){
    // Affiche un message d'erreur à coté de l'input où il y a une erreur
    if (isset($_SESSION["error"][$name])){
        return "Ce champ est incorrect";
    }
}


function showValues($name){
    // Affiche les valeurs déjà entrées histoire de ne pas devoir remplir tout le formulaire à chaque erreur.
    if(isset($_SESSION['values'][$name])){
        return $_SESSION['values'][$name];
    }
}


function selected($name, $val){
    // Sélectionne la bonne option histoire de ne pas devoir remplir tout le formulaire à chaque erreur.
    if(isset($_SESSION['values'][$name])){
        if ($_SESSION['values'][$name] == $val){
            return 'selected="selected"';
        }
    }
}

function updateSelected($name, $val){
    // Même fonction que la pécedente mais sélectionne seuelement les info de l'employé à update.
    if ($name == $val){
        return 'selected="selected"';
    }
}


function checked(){
    // Coche la chekbox si elle était coché histoire de ne pas devoir remplir tout le formulaire à chaque erreur.
    if(isset($_SESSION['values']['souper'])){
        return "checked";
    }
}

function updateCheked($souper){
    // Même fonction que la précédente mais le coche la checkbox en fonction de l'employé à update.
    if ($souper == "Oui"){
        return "checked";
    }
}


function disableOption($param){
    // Cette fonction permet de bloquer l'option d'une activité où il n'y a plus de place
    if (recupNbMax($param) == null){
        // On ne bloque jamais "Aucune activitée"
        return "";
    }
    $nbMax = (int)recupNbMax($param);
    $nbDePlacePrise = (int)recupNbDePlacePrise($param);
    if ($nbDePlacePrise >= $nbMax){
        return 'disabled style="color:red;"';
    }
}


function getElements($array, $param){
    // Cette fonction ajoute dans un array les pk qu'on met dans les values des options. Ca va servir à protéger de
    // quelqu'un qui modifie les values dans l'inspecteur.
    $lst = [];
    foreach ($array as $value) {
        array_push($lst, $value[$param]);
    }
    return $lst;
}


function checkPk($pk, $array){
    // Cette fonction vérifie si un pk de trouve dans un array.
    if (in_array($pk, $array)){
        return true;
    }
    return false;
}

?>