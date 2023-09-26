<!DOCTYPE html>
<html>
<head>
    <title>Modifier le compte</title>
</head>
<body>
    <h2>Modifier le compte</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <?php if ($updatePassword) { ?>
            <label for="newPassword">Nouveau mot de passe :</label>
            <input type="password" name="newPassword" id="newPassword"><br>
        <?php } ?>

        <?php if ($updateUsername) { ?>
            <label for="newUsername">Nouveau nom d'utilisateur :</label>
            <input type="text" name="newUsername" id="newUsername"><br>
        <?php } ?>

        <?php if ($updateEmail) { ?>
            <label for="newEmail">Nouvelle adresse e-mail :</label>
            <input type="email" name="newEmail" id="newEmail"><br>
        <?php } ?>

        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>


<?php
// Inclure la connexion à la base de données ici

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST["id"];
    $newPassword = $_POST["newPassword"];
    $newUsername = $_POST["newUsername"];
    $newEmail = $_POST["newEmail"];

    // Vérifier quelles informations doivent être mises à jour
    $updatePassword = !empty($newPassword);
    $updateUsername = !empty($newUsername);
    $updateEmail = !empty($newEmail);

    // Construire la requête SQL en fonction des mises à jour nécessaires
    $sql = "UPDATE `user` SET ";
    $updates = [];

    if ($updatePassword) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $updates[] = "`logpass` = '$newPasswordHash'";
    }

    if ($updateUsername) {
        $updates[] = "`logname` = '$newUsername'";
    }

    if ($updateEmail) {
        $updates[] = "`logemail` = '$newEmail'";
    }

    $sql .= implode(", ", $updates);
    $sql .= " WHERE `id` = $id";

    // Exécuter la requête SQL
    // Assurez-vous de sécuriser votre code contre les attaques SQL en utilisant des requêtes préparées

    // Rediriger l'utilisateur vers une page de confirmation ou de retour en arrière après la mise à jour
}
?>

