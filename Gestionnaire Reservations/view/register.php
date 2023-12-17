<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: ../view/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer</title>
</head>
<body>
    <h1 style="color:red;">
        <?php
        if (isset($_SESSION["registerError"])){
            echo "Le login ou le mot de passe est incorrecte. Le mot de passe doit contenir au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spéciale.";
        }
        ?>
    </h1>
    <form action="..\controller\register.php" method="post">
        <label>Login</label>
        <input type="text" placeholder="Login" name="login" required>
        <br>
        <br>
        <label>Mot de passe</label>
        <input type="password" name=mdp required>
        <br>
        <br>
        <label>Confirmer le mot de passe</label>
        <input type="password" name="cmdp" required>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>

<?php
unset($_SESSION["registerError"]);
?>