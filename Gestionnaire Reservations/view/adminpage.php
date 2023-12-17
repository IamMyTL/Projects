<?php
session_start();
include("../model/read.php");
include("../model/function.php");
if (!isset($_SESSION["admin"])) {
    header("Location: ../view/login.php");
}
$info = recupAllInfo("employe");
$activites = recupAllInfo('activite');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
</head>

<body>
    <h2 style="position: absolute; top: 0px; right: 50px;"><a href="register.php">Enregistrer un nouvel admin</a></h2>
    <h1>Listing Participants</h1>
    <TABLE>
        <!-- titres-->
        <TR style="font-weight: bold;">
            <TD>Nom</TD>
            <TD>Prenom</TD>
            <TD>Mail</TD>
            <TD>Code postal</TD>
            <TD>Locomotion</TD>
            <TD>Département</TD>
            <TD>Souper</TD>
            <TD>Modify/Delete</TD>
        </TR>
        <!-- Données-->
        <?php foreach ($info as $i) { ?>
            <TR>
                <TD><?= $i['nom']; ?></TD>
                <TD><?= $i['prenom']; ?></TD>
                <TD><?= $i['mail']; ?></TD>
                <TD><?= recupFromFk("cp", (int)$i["fk_cp"], "cp"); ?> <?= recupFromFk("cp", (int)$i["fk_cp"], "nom"); ?></TD>
                <TD><?= recupFromFK("locomotion", (int)$i['fk_locomotion'], "nom"); ?></TD>
                <TD><?= recupFromFk("departement", (int)$i["fk_departement"], "nom"); ?></TD>
                <TD><?= $i['souper']; ?></TD>
                <TD><a href="../view/updateEmploye.php?pk=<?= $i['pk_employe']; ?>">Modifier</a>/<a href="../controller/deleteEmploye.php?pk=<?= $i['pk_employe']; ?>">Supprimer</a></TD>
            </TR>
        <?php } ?>
    </TABLE>
    <br>
    <select name="activites" id="activites" onChange="update()">
        <?php foreach ($activites as $act) { ?>
            <option value="<?= $act['pk_activite']; ?>"><?= $act['nom']; ?></option>
        <?php } ?>
    </select>
    <!-- Les tableaux affichés changent en fonction des activités qu'il y a dans la table activite.
        On peut ajouter ou supprimer des activités et le nombre de tableaux affichés changera avec les données. -->
    <?php
    $AllPkActivite = recupAllPkActivite();
    if ($AllPkActivite != FALSE){
        foreach($AllPkActivite as $PkActivite){
    ?>
        <?php
        $activite = (recupEmployeActivity($PkActivite['pk_activite'])=="NULL"?[]:recupEmployeActivity($PkActivite['pk_activite']));
        unset($c);
        ?>
        <div id=<?= (string)$PkActivite['pk_activite'] ?> style="display:none;">
            <h1><?= recupNomActivite($PkActivite['pk_activite']) ?> <?= recupNbDePlacePrise($PkActivite['pk_activite']) ?>/<?= recupNbMax($PkActivite['pk_activite'])!=null?recupNbMax($PkActivite['pk_activite']):recupNbDePlacePrise($PkActivite['pk_activite']) ?></h1>
            <TABLE>
                <!-- titres-->
                <TR style="font-weight: bold;">
                    <TD>Nom</TD>
                    <TD>Prénom</TD>
                </TR>
                <!-- Données-->
                <?php foreach($activite as $c){ ?>
                    <TR>
                        <TD><?= $c['nom']; ?></TD>
                        <TD><?= $c['prenom']; ?></TD>
                    </TR>
                <?php } ?>
            </TABLE>
        </div>
    <?php
        }
    }
    ?>
    <script src="../js/main.js"></script>
</body>

</html>