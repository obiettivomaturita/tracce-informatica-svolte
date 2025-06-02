<?php
require "db_connection.php";

$city =$_POST["Città"];

$query = "";
if ($city === "Tutti" || empty($city)) {
    $query = "
    SELECT P.Denominazione, COUNT(*) AS Num_Prenotazioni
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN PRENOTARE PR ON A.IDP = PR.IDP AND A.IDA = PR.IDA
    WHERE  YEAR(PR.Data_prenotazione) = YEAR(CURDATE())
    GROUP BY P.IDP, P.Denominazione
    ORDER BY Num_Prenotazioni DESC;
    
    ";
    $stmt = $connection->prepare($query);
} else {
    $query = "
    SELECT P.Denominazione, COUNT(*) AS Num_Prenotazioni
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN PRENOTARE PR ON A.IDP = PR.IDP AND A.IDA = PR.IDA
    WHERE P.Città = ? 
    AND YEAR(PR.Data_prenotazione) = YEAR(CURDATE())
    GROUP BY P.IDP, P.Denominazione
    ORDER BY Num_Prenotazioni DESC;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $city);
}

if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Classifica Palestre</title>
</head>
<body>
    <h1>Classifica delle Palestre (Prenotazioni Annuali)</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr><th>Palestra</th><th>Numero Prenotazioni</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Denominazione"] . "</td>";
            echo "<td>" . $row["Num_Prenotazioni"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessuna prenotazione trovata.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

