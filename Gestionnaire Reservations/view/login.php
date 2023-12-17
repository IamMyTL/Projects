<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1 style="color:red;">
        <?php
        if (isset($_GET["register"])){
            echo "Vous avez bien été enregistré.";
        }
        if (isset($_SESSION["wrong"])){
            echo "Login ou mot de passe incorrecte.";
        }
        ?>
    </h1>
    <h2>
        <form action="..\controller\login.php" method="post">
            <label>Login</label>
            <input type="text" placeholder="Login" name="login" required>
            <br>
            <br>
            <label>Mot de passe</label>
            <input type="password" name="mdp" required>
            <br>
            <br>
            <input type="submit" value="Se connecter">
        </form>
    </h2>
</body>
</html>

<?php
unset($_SESSION["wrong"]);
?>