<?php
require "db_connection.php";

$query = "
    SELECT S.Provincia, AVG(P.LatteLavorato) AS MediaLatteLavorato
    FROM SEDE S
    INNER JOIN CASEIFICIO C ON S.IDC = C.IDC
    INNER JOIN PRODUZIONE P ON C.IDC = P.IDC
    WHERE YEAR(P.DATA) = YEAR(CURDATE())
    GROUP BY S.Provincia;
";

$stmt = $connection->prepare($query);
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
    <title>Media Latte Lavorato per Provincia</title>
</head>
<body>
    <h1>Media del Latte Lavorato (Anno Corrente) per Provincia</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr><th>Provincia</th><th>Media Latte Lavorato</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Provincia"] . "</td>";
            echo "<td>" . $row["MediaLatteLavorato"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessun record trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

