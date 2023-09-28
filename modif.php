<?php
// Inclure la configuration de la base de données ici
$servername = "192.168.65.252";
$username = "root";
$password = "root";
$dbname = "TpGPS";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $newPassword = $_POST["newPassword"];
    $newUsername = $_POST["newUsername"];
    $newEmail = $_POST["newEmail"];

    // Vérifier quelles informations l'utilisateur souhaite mettre à jour
    if (!empty($newPassword)) {
        // Mettre à jour le mot de passe
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE `user` SET `logpass` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $newPasswordHash, $id);
        if ($stmt->execute()) {
            echo "Mot de passe mis à jour avec succès.<br>";
        } else {
            echo "Erreur lors de la mise à jour du mot de passe : " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    if (!empty($newUsername)) {
        // Mettre à jour le nom d'utilisateur
        $stmt = $conn->prepare("UPDATE `user` SET `logname` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $newUsername, $id);
        if ($stmt->execute()) {
            echo "Nom d'utilisateur mis à jour avec succès.<br>";
        } else {
            echo "Erreur lors de la mise à jour du nom d'utilisateur : " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    if (!empty($newEmail)) {
        // Mettre à jour l'adresse e-mail
        $stmt = $conn->prepare("UPDATE `user` SET `logemail` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $newEmail, $id);
        if ($stmt->execute()) {
            echo "Adresse e-mail mise à jour avec succès.<br>";
        } else {
            echo "Erreur lors de la mise à jour de l'adresse e-mail : " . $stmt->error . "<br>";
        }
        $stmt->close();
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le compte</title>
</head>
<body>
    <h2>Modifier le compte</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label for="newPassword">Nouveau mot de passe :</label>
        <input type="password" name="newPassword" id="newPassword"><br>

        <label for="newUsername">Nouveau nom d'utilisateur :</label>
        <input type="text" name="newUsername" id="newUsername"><br>

        <label for="newEmail">Nouvelle adresse e-mail :</label>
        <input type="email" name="newEmail" id="newEmail"><br>

        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
