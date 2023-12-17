<?php
if (isset($visits) && !empty($visits)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des séjours</title>
</head>
<body>
    <ul>
        <?php foreach($visits as $visit): ?>
            <li><?= $visit->id; ?></li>
            <li><?= $visit->date; ?></li>
            <li><a class="object" href="../animal/one?id=<?= $visit->animal->id ?>"><?= $visit->animal->name ?></a></li>
            <br>
            <?php endforeach; ?>
    </ul>
</body>
</html>
<?php endif; ?>