<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION["userId"])) {
    header("Location: login.php"); // Redirige l'utilisateur vers la page de connexion si non connecté
    exit();
}

// Inclut la classe de gestion de la connexion à la base de données
require_once("connexion_manager.php"); // Assurez-vous de renommer le fichier de gestion de la connexion en conséquence

// Initialisez la classe ConnexionManager
$connexionManager = new ConnexionManager();

// Récupérez les informations de l'utilisateur actuellement connecté
$userId = $_SESSION["userId"];
$userInfo = $connexionManager->getUserInfo($userId);

// Vérifie si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modify"])) {
    // Récupérez les données du formulaire
    $newLogname = $_POST["new_logname"];
    $newLogpass = $_POST["new_logpass"];
    $newLogemail = $_POST["new_logemail"];

    // Appelez la méthode pour mettre à jour les informations de l'utilisateur
    $connexionManager->updateUser($userId, $newLogname, $newLogpass, $newLogemail);

    // Redirigez l'utilisateur vers une page de confirmation ou une autre page appropriée
    header("Location: profile.php");
    exit();
}

$connexionManager->closeConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier le profil</title>
</head>
<body>
    <h1>Modifier le profil</h1>
    <form method="POST" action="">
        <label for="new_logname">Nouveau nom d'utilisateur :</label>
        <input type="text" id="new_logname" name="new_logname" value="<?php echo $userInfo["logname"]; ?>" required><br>

        <label for="new_logpass">Nouveau mot de passe :</label>
        <input type="password" id="new_logpass" name="new_logpass" required><br>

        <label for="new_logemail">Nouvelle adresse e-mail :</label>
        <input type="email" id="new_logemail" name="new_logemail" value="<?php echo $userInfo["logemail"]; ?>" required><br>

        <input type="submit" name="modify" value="Modifier">
    </form>
    <a href="profile.php">Retour au profil</a>
</body>
</html>
