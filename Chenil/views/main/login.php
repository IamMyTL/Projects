<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/scripts/login.js"></script>
    <title>Login</title>
</head>
<body>
    <h1>Se connecter en tant qu'admin</h1>
    <form action="../user/adminLogin" method="post">
        <label>Nom d'utilisateur</label>
        <input type="text" placeholder="Nom d'utilisateur" name="username" required>
        <label>Mot de passe</label>
        <input type="password" name="pass" required>
        <input type="submit" value="Se connecter">
    </form>
    <h1>Se connecter en tant que propriétaire</h1>
    <form action="../user/ownerLogin" method="post">
        <label>Mail</label>
        <input type="email" placeholder="Mail" name="mail" required>
        <label>Mot de passe</label>
        <input type="password" name="pass" required>
        <input type="submit" value="Se connecter">
    </form>
    <h2 style="color:red;">
        <?php
        if (isset($_SESSION["errLogin"])){
            echo "Email ou mot de passe incorrect.";
        }
        ?>
    </h2>
    <h1>Pas enore de compte?</h1>
    <h2 style="color:red;">
        <?php
        if (isset($_SESSION["errCreate"])){
            echo "Email ou mot de passe incorrect.  Le mot de passe doit contenir au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spéciale.";
        }
        elseif (isset($_SESSION["registered"])){
            echo "Compte créé";
        }
        ?>
    </h2>
    <div class="register"></div>
</body>
</html>

<?php
unset($_SESSION["errCreate"]);
unset($_SESSION["registered"]);
unset($_SESSION["errLogin"]);
?>