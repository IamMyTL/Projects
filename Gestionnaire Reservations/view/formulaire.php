<?php
session_start();

include('../model/read.php');
include('../model/function.php');
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
    <title>Formulaire</title>
</head>

<body>
    <h1>Inscription journée du personnel !</h1>
    <h2 style="position: absolute; top: 0px; right: 50px;"><a href="adminpage.php">Page admin</a></h2>
    <form id="contact" action="..\controller\formulaire.php" method="post">
        <h3>Contact</h3>
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
        <input placeholder="Nom" name="nom" type="text" value="<?= showValues("nom") ?>" required>
        <span style="color:red;"><?= showError("nom") ?></span>
        <br>
        <br>
        <label>Votre prénom :</label>
        <input placeholder="Prénom" name="prenom" type="text" value="<?= showValues("prenom") ?>" required>
        <span style="color:red;"><?= showError("prenom") ?></span>
        <br>
        <br>
        <label>Votre mail :</label>
        <input placeholder="Mail" name="mail" type="email" value="<?= showValues("mail") ?>" required>
        <span style="color:red;"><?= showError("mail") ?></span>
        <br>
        <br>
        <label>Votre code postal :</label>
        <select name="cp" id="cp">
            <?php foreach ($cp as $cp) { ?>
                <option value="<?= $cp['pk_cp']; ?>" <?= selected("cp", $cp['pk_cp']) ?>><?= $cp['cp']; ?> <?= $cp['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre moyen de locomotion pour arrivé :</label>
        <select name="locomotion" id="locomotion">
            <?php foreach ($locomotion as $locomotion) { ?>
                <option value="<?= $locomotion['pk_locomotion']; ?>" <?= selected("locomotion", $locomotion['pk_locomotion']) ?>><?= $locomotion['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre département au sein de la société :</label>
        <select name="departement" id="departement">
            <?php foreach ($departement as $departement) { ?>
                <option value="<?= $departement['pk_departement']; ?>" <?= selected("departement", $departement['pk_departement']) ?>><?= $departement['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Votre activité choisie :</label>
        <select name="activite" id="activite">
            <?php foreach ($activite as $activite) { ?>
                <option value="<?= $activite['pk_activite']; ?>" <?= selected("activite", $activite['pk_activite']) ?> <?= disableOption($activite['pk_activite']) ?>><?= $activite['nom']; ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <label>Participerez-vous au souper ce soir?</label>
        <input type="checkbox" id="souper" name="souper" <?= checked() ?>>
        <br>
        <br>
        <input type="submit" value="Envoyer">

    </form>
</body>

</html>
<?php
unset($_SESSION["error"]);
unset($_SESSION["values"]);
?>