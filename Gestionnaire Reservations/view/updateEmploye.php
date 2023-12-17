<?php
session_start();
include("../model/read.php");
include("../model/function.php");
if (isset($_SESSION["current_pk_employe"])){
    $pk = $_SESSION["current_pk_employe"];
}else{
    $pk = (int)$_GET['pk'];
    $_SESSION["current_pk_employe"] = $pk;
}
$employe = recupInfo($pk);
$pk_activite = recupActivite($pk);
$_SESSION["last_pk_activite"] = $pk_activite;
$_SESSION["pk_updateEmploye"] = $pk;
$_SESSION["last_name_employe"] = $employe["nom"];
$_SESSION["last_firstname_employe"] = $employe["prenom"];


$cp = recupAllInfo('cp');
$locomotion = recupAllInfo('locomotion');
$departement = recupAllInfo('departement');
$activite = recupAllInfo('activite');

$_SESSION['elements']['cp'] = getElements($cp, "pk_cp");
$_SESSION['elements']['locomotion'] = getElements($locomotion, "pk_locomotion");
$_SESSION['elements']['departement'] = getElements($departement, "pk_departement");
$_SESSION['elements']['activite'] = getElements($activite, "pk_activite");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Employer</title>
</head>
<body>
    <form id="contact" action="..\controller\updateEmploye.php" method="post">
        <h2 style="color:red;">
        <?php
            if (isset($_SESSION["error"]["existe"])){
                echo "Cette personne existe déjà dans la db";
            }
            if (isset($_SESSION["error"]["nbmax"])){
                echo "Il n'y a plus de place dans l'activité que vous avez choisi";
            }
            if (isset($_SESSION["error"]["triche"])){
                echo "Ne modifiez pas les values dans l'inspecteur";
            }
        ?>
        </h2>
        <label>Votre nom :</label>
        <input placeholder="Nom" name="nom" type="text" value="<?= $employe["nom"] ?>" required>
        <span style="color:red;"><?= showError("nom") ?></span>
        <br>
        <br>
        <label>Votre prénom :</label>
        <input placeholder="Prénom" name="prenom" type="text" value="<?= $employe["prenom"] ?>" required>
        <span style="color:red;"><?= showError("prenom") ?></span>
        <br>
        <br>
        <label>Votre mail :</label>
        <input placeholder="Mail" name="mail" type="email" value="<?= $employe["mail"] ?>" required>
        <span style="color:red;"><?= showError("mail") ?></span>
        <br>
        <br>
        <label>Votre code postal :</label>
        <select name="cp" id="cp">
            <?php foreach ($cp as $cp) { ?>
                <option value="<?= $cp['pk_cp']; ?>" <?= updateSelected($employe['fk_cp'], $cp['pk_cp']) ?>><?= $cp['cp']; ?> <?= $cp['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre moyen de locomotion pour arrivé :</label>
        <select name="locomotion" id="locomotion">
            <?php foreach ($locomotion as $locomotion) { ?>
                <option value="<?= $locomotion['pk_locomotion']; ?>" <?= updateSelected($employe['fk_locomotion'], $locomotion['pk_locomotion']) ?>><?= $locomotion['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre département au sein de la société :</label>
        <select name="departement" id="departement">
            <?php foreach ($departement as $departement) { ?>
                <option value="<?= $departement['pk_departement']; ?>" <?= updateSelected($employe['fk_departement'], $departement['pk_departement']) ?>><?= $departement['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre activité choisie :</label>
        <select name="activite" id="activite">
            <?php foreach ($activite as $activite) { ?>
                <option value="<?= $activite['pk_activite']; ?>" <?= updateSelected($pk_activite, $activite['pk_activite']) ?> <?= disableOption($activite['pk_activite']) ?>><?= $activite['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Participerez-vous au souper ce soir?</label>
        <input type="checkbox" id="souper" name="souper" <?= updateCheked($employe["souper"]) ?>>
        <br>
        <br>
        <input type="submit" value="Envoyer">

    </form>
</body>
</html>

<?php
unset($_SESSION["error"]);
?>