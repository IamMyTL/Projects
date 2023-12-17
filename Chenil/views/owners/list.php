<?php
if (isset($owners) && !empty($owners)):
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
        <?php foreach($owners as $owner): ?>
            <li><a class="object" href="../owner/one?id=<?= $owner->id ?>"><?= $owner->name; ?> <?= $owner->firstname; ?></a></li>
            <!-- <ul>
                <?php foreach($owner->animals as $animal): ?>
                    <li><a href="../animal/one?id=<?= $animal->id ?>"><?= $animal->name ?></a></li>
                <?php endforeach; ?>
            </ul> -->
            <br>
            <?php endforeach; ?>
    </ul>
</body>
</html>
<?php endif; ?>