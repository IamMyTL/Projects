<?php
include("../model/delete.php");
$pk = (int)$_GET["pk"];
deleteEmployeChild($pk);    // Je sais qu'on peut delete en cascade mais j'ai pas setup mes fk comme ça au début du projet et 
deleteEmploye($pk);         // j'ai la flemme de modifier du coup je supprime manuellement la table intermédiaire.
header('Location: ..\view\adminpage.php');


?>