<form action="../user/addNewOwner" method="post">
    <label>Nom</label><br>
    <input type="text" placeholder="Nom" name="name" required><br>
    <label>Prénom</label><br>
    <input type="text" placeholder="Prénom" name="firstname" required><br>
    <label>Date de naissance</label><br>
    <input type="date" name="birthdate" required><br>
    <label>Mail</label><br>
    <input type="email" placeholder="Mail" name="mail" required><br>
    <label>Numéro de téléphone</label><br>
    <input type="text" placeholder="Téléphone" name="phone" required><br>
    <label>Mot de passe</label><br>
    <input type="password" name="pass" required><br>
    <label>Confirmer mot de passe</label><br>
    <input type="password" name="cpass" required><br>
    <input type="submit" value="Enregistrer">
</form>