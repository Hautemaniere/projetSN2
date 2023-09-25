<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["inscription"])) {
    // Récupérez les données du formulaire
    $name = $_POST["logname"];
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

    // Requête SQL pour insérer un nouvel utilisateur
    $sql = "INSERT INTO user (logname, logemail, logpass) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: page.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Fermez la connexion à la base de données
    $conn->close();
}
?>
