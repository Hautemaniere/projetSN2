<?php
// Inclure la logique de connexion à la base de données
include('conf.php'); // Assurez-vous de créer un fichier "connexion.php" avec les informations de connexion

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
    include 'affiche2.php'; 
    ?>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des données de la base de données</h1>

    <?php
    // Connexion à la base de données (remplacez les valeurs par les vôtres)
    $servername = "192.168.65.252";
    $username = "root";
    $password = "root";
    $dbname = "TpGPS";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Sélectionner toutes les données de la table (remplacez "ma_table" par le nom de votre table)
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les données dans un tableau HTML
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Mot de passe</th><th>Email</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["logname"] . "</td>";
            echo "<td>" . $row["logpass"] . "</td>";
            echo "<td>" . $row["logemail"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Aucune donnée trouvée dans la table.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>
    
</body>
</html>
    <?php
} else {
    // L'utilisateur n'est pas un administrateur, redirigez-le ou affichez un message d'erreur
    echo "Désolé, vous n'avez pas l'autorisation d'accéder à cette page.";
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>


