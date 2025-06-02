<?php
require 'db_connection.php';

$query = "SELECT M.Tipologia, SUM(P.Quantità) AS Q_Totale
          FROM MIELE M
          INNER JOIN APIARIO AP ON M.IDM = AP.IDM
          INNER JOIN PRODUZIONE P ON P.IDA = AP.IDA
          GROUP BY M.Tipologia";

$result = $connection->query($query);
if (!$result) {
    die("Errore nell'esecuzione della query: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Produzione Totale per Tipologia di Miele</title>
</head>
<body>
    <h1>Produzione Totale per Tipologia di Miele</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr><th>Tipologia</th><th>Quantità Totale</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Tipologia"] . "</td>";
            echo "<td>" . $row["Q_Totale"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessun record trovato.</p>";
    }
    $result->free();
    $connection->close();
    ?>
</body>
</html>