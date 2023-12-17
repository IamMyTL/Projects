<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["adminIsLogged"])){
    header("Location: ../main/login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/scripts/script.js"></script>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Main</title>
</head>
<body>
    <select name="lists" id="lists-select">
        <option value="owner" selected>Propriétaires</option>
        <option value="animal">Animaux</option>
        <option value="visit">Séjours</option>
    </select>
    <a id="accueil" href="../main" style="display:none;">Page d'accueil</a>
    <div class="content"></div>
</body>
</html>