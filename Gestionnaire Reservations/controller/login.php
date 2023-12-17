<?php
session_start();
include("../model/read.php");
$data = $_POST;
unset($_POST);

// htmlspecialchars et trim
foreach($data as &$value){
    $value = htmlspecialchars(trim($value));
}

// On récupère le mdp du login ci ce dernier existe dans la db.
$mdp = recupMdp($data["login"]);
if (!$mdp){
    $_SESSION["wrong"] = "True";
    header("Location: ../view/login.php");
    exit();
}
$verify = password_verify($data["mdp"], $mdp);
unset($data["mdp"]);    // Pour plus de sécurité on unset le mdp maintenant qu'on en a plus besoin.

if(!$verify){
    $_SESSION["wrong"] = "True";
    $url = "Location: ../view/login.php"; 
}else{
    $_SESSION["admin"] = "True";
    $url = "Location: ../view/adminpage.php"; 
}
header($url);
?>