<?php
if (isset($animals) && !empty($animals)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des animaux</title>
</head>
<body>
    <ul>
        <?php foreach($animals as $animal): ?>
            <li><a class="object" href="../animal/one?id=<?= $animal->id; ?>"><?= $animal->name; ?></a></li>
            <!-- <li><a href="../owner/one?id=<?= $animal->owner->id; ?>"><?= $animal->owner; ?></a></li> -->
            <br>
            <?php endforeach; ?>
    </ul>
</body>
</html>
<?php endif; ?>