<?php
require 'db_connection.php';

$query = "SELECT Regione, COUNT(*) AS N_APIARI FROM Apiari GROUP BY Regione";
$result = $connection->query($query);
if (!$result) {
    die("Errore nell'esecuzione della query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Conteggio Apiari per Regione</title>
</head>
<body>
    <h1>Conteggio Apiari per Regione</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Regione</th>";
        echo "<th>Numero di Apiari</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Regione"] . "</td>";
            echo "<td>" . $row["N_APIARI"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessun dato trovato.</p>";
    }
    $result->free();
    $connection->close();
    ?>
</body>
</html>