<?php
include("../model/read.php");
include("../model/insert.php");
session_start();
$data = $_POST;
unset($_POST);

// htmlspecialchars et trim
foreach($data as &$value){
    $value = htmlspecialchars(trim($value));
}


$allLogin = recupAllLogin();
if ($allLogin != "NULL"){
    foreach($allLogin as $value2){
        if ($value2["login"] == $data["login"]){    // On empêche d'entrer un login qui est déjà dans la db.
            $_SESSION["registerError"]["login"] = "True";
            header("Location: ../view/register.php");
            exit();
        }
    }
}

// Mot de passe utilisé pour tester => Testdemdp1/
if ($data["mdp"] != $data["cmdp"]           // Mdp = confirmation du mdp
    || !preg_match('@[A-Z]@', $data["mdp"]) // Majuscule
    || !preg_match('@[a-z]@', $data["mdp"]) // Minuscule
    || !preg_match('@[0-9]@', $data["mdp"]) // Chiffre
    || !preg_match('@[^\w]@', $data["mdp"]) // Symbole
    || strlen($data["mdp"]) < 8){           // 8 caractères
    $_SESSION["registerError"]["mdp"] = "True";
    unset($data['mdp']);   // Pour plus de sécurité on unset les mdp maintenant qu'on en a plus besoin
    unset($data['cmdp']);
    $url = "Location: ../view/register.php";
}else{
    $data['mdp'] = password_hash($data['mdp'], PASSWORD_BCRYPT);
    unset($data['cmdp']);
    insertLoginAdmin($data["login"], $data['mdp']);
    $url = "Location: ../view/login.php?register=true";
}

header($url);
?>