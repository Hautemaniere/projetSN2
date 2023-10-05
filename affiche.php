<?php
// Inclure la logique de connexion à la base de données
include('conf.php'); // Assurez-vous de créer un fichier "conf.php" avec les informations de connexion

// Vérifier si l'utilisateur est connecté et si sa session est active
session_start();
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers une page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit;
}

// Récupérer l'ID de l'utilisateur connecté depuis la session
$user_id = $_SESSION['user_id'];

// Vérifier le statut "IsAdmin" de l'utilisateur dans la base de données
$query = "SELECT `IsAdmin` FROM `user` WHERE `id` = $user_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erreur de requête : " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

if ($row['IsAdmin'] == 1) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Page d'administration</title>
    </head>
    <body>
        <h1>Bienvenue sur la page d'administration</h1>
        <!-- Mettez ici le contenu de la page réservée aux administrateurs -->
    </body>
    </html>
    <?php
} else {
    // L'utilisateur n'est pas un administrateur, vous pouvez afficher un message d'erreur ou rediriger vers une autre page
    // Par exemple, vous pouvez rediriger vers une page d'accès refusé
    header("Location: access_denied.php");
    exit;
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>


