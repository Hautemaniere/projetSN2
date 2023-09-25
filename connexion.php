<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
    // Récupérez les données du formulaire
    $email = $_POST["logemail"];
    $password = $_POST["logpass"];
    
    // Remplacez les données de connexion à votre base de données
    $servername = "192.168.65.252";
    $username = "root";
    $password_db = "root";
    $dbname = "TpGPS";

    // Établissez la connexion à la base de données
    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête SQL pour vérifier l'utilisateur
    $sql = "SELECT * FROM user WHERE logemail='$email' AND logpass='$password'";
    $result = $conn->query($sql);

    // Si l'utilisateur est trouvé, redirigez-le vers page.php
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["userId"] = $row["id"];
        $_SESSION["logname"] = $row["logname"];
        header("Location: page.php");
        exit();
    } else {
        echo "Invalid email or password.";
    }

    // Fermez la connexion à la base de données
    $conn->close();
}
?>
