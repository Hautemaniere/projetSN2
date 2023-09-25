<?php
class ConnexionManager {
    private $conn;

    public function __construct() {
        // Remplacez les données de connexion à votre base de données
        $servername = "192.168.65.252";
        $username = "root";
        $password_db = "root";
        $dbname = "TpGPS";

        // Établissez la connexion à la base de données
        $this->conn = new mysqli($servername, $username, $password_db, $dbname);

        // Vérifiez la connexion
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function checkUser($email, $password) {
        // Requête SQL pour vérifier l'utilisateur
        $sql = "SELECT * FROM user WHERE logemail='$email' AND logpass='$password'";
        $result = $this->conn->query($sql);

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
    }

    public function closeConnection() {
        // Fermez la connexion à la base de données
        $this->conn->close();
    }
}

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
    // Récupérez les données du formulaire
    $email = $_POST["logemail"];
    $password = $_POST["logpass"];

    $connexionManager = new ConnexionManager();
    $connexionManager->checkUser($email, $password);
    $connexionManager->closeConnection();
}
?>
