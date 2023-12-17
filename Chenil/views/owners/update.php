<?php if (isset($owner) && !empty($owner)): ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <title>Modifier propriétaire</title>
</head>
<body>
    <form action="../user/addNewOwner" method="post">
        <input type="hidden" name="id" value="<?= $owner->id ?>">
        <label>Nom</label><br>
        <input type="text" placeholder="Nom" name="name" value="<?= $owner->name ?>" required><br>
        <label>Prénom</label><br>
        <input type="text" placeholder="Prénom" name="firstname" value="<?= $owner->firstname ?>" required><br>
        <label>Date de naissance</label><br>
        <input type="date" name="birthdate" value="<?= $owner->birthdate ?>" required><br>
        <label>Mail</label><br>
        <input type="email" placeholder="Mail" name="mail" value="<?= $owner->mail ?>" required><br>
        <label>Numéro de téléphone</label><br>
        <input type="text" placeholder="Téléphone" name="phone" value="<?= $owner->phone ?>" required><br>
        <label>Mot de passe</label><br>
        <input type="password" name="pass" required><br>
        <label>Confirmer mot de passe</label><br>
        <input type="password" name="cpass" required><br>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>
<?php endif; ?>