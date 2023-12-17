<?php
if (!isset($animal)){
    $animal = new Animal(false, false, false, false, 2, false, false, false);
}
function showData($obj, $prop){
        return $obj->$prop;
    }
?>
<form id="create-animal-form">
    <div class="check">
        <h2 class="check-false" style="color:red; display:none;">
            Erreur, vérifiez bien les champs que vous avez entré.
        </h2>
        <h2 class="check-true" style="color:red; display:none;">
            Animal ajouté
        </h2><br>
    </div>
    <label>Nom</label><br>
    <input type="hidden" value="<?= $animal->id ?>" id="animal-id">
    <input type="text" placeholder="Nom" name="name" id="name" value="<?= showData($animal, "name") ?>" required><br>
    <label>Sexe</label><br>
    <input type="radio" name="gender" id="male" value="M" <?= $animal->gender=="M"?"checked":"" ?> required>
    <label for="male">Mâle</label><br>
    <input type="radio" name="gender" id="femelle" value="F" <?= $animal->gender=="F"?"checked":"" ?>>
    <label for="femelle">Femelle</label><br>
    <label>Date de naissance</label><br>
    <input type="date" name="birthdate" value="<?= showData($animal, "birthdate") ?>" required><br>
    <label>Stérilisé</label><br>
    <input type="radio" name="sterilized" id="non" value="0" <?= $animal->sterilized=="0"?"checked":"" ?> required>
    <label for="non">Non</label><br>
    <input type="radio" name="sterilized" id="oui" value="1" <?= $animal->sterilized=="1"?"checked":"" ?>>
    <label for="oui">Oui</label><br>
    <label>Numéro de puce</label><br>
    <input type="text" placeholder="Puce" name="chip_id" id="chip_id" value="<?= showData($animal, "chip_id") ?>" required><br>
    <input type="submit" value="Enregistrer">
</form>