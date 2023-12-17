<?php
if (isset($owners) && !empty($owners)):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétaire</title>
</head>
<body>
    <!-- <a id="accueil" href="../main">Page d'accueil</a> -->
    <ul>
        <span class="owner-id" style="display:none;"><?= $owners->id ?></span>
        <span><a class="updateOwner" href="../owner/showUpdate?id=<?= $owners->id ?>"><b>✏️Modifier Propriétaire</b></a></span>
        <li><?= $owners->name ?></li> 
        <li><?= $owners->firstname ?></li>
        <li><?= $owners->birthdate ?></li>
        <li><?= $owners->mail ?></li>
        <li><?= $owners->phone ?></li>
        <a class="add" href="../animal/create"><b>➕Ajouter un animal</b></a>
        <div class="create-animal"></div>
            <?php if ($owners->animals): ?>
                <ul>
                <?php foreach($owners->animals as $animal): ?>
                    <li><a class="object" href="../animal/one?id=<?= $animal->id ?>"><?= $animal->name ?></a>
                        <?php if (!$animal->visits): ?>
                            <!-- Ajoute les boutons edit et delete que si l'animale n'a pas de séjours -->           
                            <a class="edit" href="../animal/edit?id=<?= $animal->id ?>">✏️</a>                 
                            <a class="delete" href="../animal/destroy?idAnimal=<?= $animal->id ?>">❌</a>
                        <?php endif; ?>
                        <ul style="display:inline;">
                            <li><?= $animal->gender ?></li>
                            <li><?= $animal->birthdate ?></li>
                            <li><?= $animal->sterilized ?></li>
                            <li><?= $animal->chip_id ?></li>
                        </ul>
                    </li>
                    <ul>
                        <a class="add-visit <?= $animal->id ?> add-visit<?= $animal->id ?> closed" href="../visit/create"><b>➕Ajouter un séjour</b></a>
                        <div class="create-visit <?= $animal->id ?> create-visit<?= $animal->id ?>"></div>
                        <?php 
                        if ($animal->visits):
                            foreach($animal->visits as $visit): 
                            ?>
                                <li>
                                    <a class="object" href="../visit/one?id=<?= $visit->id ?>">Séjour n°<?= $visit->id ?> <?= $visit->date ?></a>
                                    <a class="delete" href="../visit/destroy?idVisit=<?= $visit->id ?>">❌</a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                <?php endforeach; ?>
                </ul>
                <?php else: ?>
                    <a class="delete delete-owner" href="../owner/destroy?idOwner=<?= $owners->id ?>">❌Supprimer le propriétaire</a>
                <?php endif; ?>
    </ul>
</body>
</html>
<?php endif; ?>