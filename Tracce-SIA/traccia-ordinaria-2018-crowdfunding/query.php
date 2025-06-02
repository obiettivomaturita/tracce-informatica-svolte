<?php
require "db_connection.php";

$query = "
    SELECT P.IDP, P.Titolo,P.Totale_finanziamento, P.Scadenza, SUM(D.Importo) AS TotaleRaccolto
    FROM PROGETTO P
    INNER JOIN DONAZIONE D ON P.IDP = D.IDP AND D.Stato = 'versata'
    WHERE P.Stato = 'attivo'
      AND P.Scadenza >= CURDATE()
    GROUP BY P.IDP, P.Titolo ,  P.Totale_finanziamento, P.Scadenza
    HAVING TotaleRaccolto < P.Totale_finanziamento
";

$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Progetti da finanziare</title>
</head>
<body>
    <h1>Progetti ancora da finanziare</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row["Titolo"] . "</h3>";
            echo "<p><strong>Totale richiesto:</strong> €" . $row["Totale_finanziamento"] . "</p>";
            echo "<p><strong>Scadenza raccolta:</strong> " . $row["Scadenza"] . "</p>";
        }
    } else {
        echo "<p>Nessun progetto attualmente richiede donazioni.</p>";
    }

    $connection->close();
    ?>
</body>
</html>
