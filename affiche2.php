<!DOCTYPE html>
<html>
<head>
    <title>Affichage des données de la base de données</title>
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
