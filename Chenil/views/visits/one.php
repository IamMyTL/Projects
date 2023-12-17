<?php
if (isset($visits) && !empty($visits)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séjour</title>
</head>
<body>
    <!-- <a id="accueil" href="../main">Page d'accueil</a> -->
    <ul>
        <li><?= $visits->id ?></li>
        <li><?= $visits->date ?></li>
        <li><?= $visits->rate ?>%</li>
        <li><a class="object" href="../animal/one?id=<?= $visits->animal->id ?>"><?= $visits->animal->name ?></a></li>
    </ul>
</body>
</html>
<?php endif; ?>