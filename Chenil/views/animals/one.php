<?php
if (isset($animals) && !empty($animals)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal</title>
</head>
<body>
    <!-- <a id="accueil" href="../main">Page d'accueil</a> -->
    <ul>
        <li><?= $animals->name; ?></li>
        <li><?= $animals->gender; ?></li>
        <li><?= $animals->birthdate; ?></li>
        <li><?= $animals->sterilized; ?></li>
        <li><?= $animals->chip_id; ?></li>
        <li><a class="object" href="../owner/one?id=<?= $animals->owner->id; ?>"><?= $animals->owner; ?></a></li>
        <li>Visite(s):
            <ul>
                <?php 
                if ($animals->visits):
                    foreach($animals->visits as $visit): 
                ?>
                        <li><a class="object" href="../visit/one?id=<?= $visit->id ?>"><?= $visit->id ?> <?= $visit->date ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
</body>
</html>
<?php endif; ?>