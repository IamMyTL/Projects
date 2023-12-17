<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["ownerIsLogged"])){
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
    <script src="/scripts/dashboardOwner.js"></script>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="owner" id="ownerId" data-value="<?= $_SESSION["ownerIsLogged"] ?>"></div>
</body>
</html>