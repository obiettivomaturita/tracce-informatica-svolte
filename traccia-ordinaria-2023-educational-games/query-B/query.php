<?php
require "db_connection.php";

$idp =$_POST["IDP"];

if ($idp === "Tutti") {
    $query = "
    SELECT P.Denominazione, SUM(A.Prezzo) AS Importo_Totale
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN PRENOTARE PR ON A.IDP = PR.IDP AND A.IDA = PR.IDA
    WHERE MONTH(PR.Data_prenotazione) = 4
    AND YEAR(PR.Data_prenotazione) = YEAR(CURDATE())
    GROUP BY P.IDP, P.Denominazione;
    ";
    $stmt = $connection->prepare($query);
} else {
    $query = "
    SELECT P.Denominazione, SUM(A.Prezzo) AS Importo_Totale
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN PRENOTARE PR ON A.IDP = PR.IDP AND A.IDA = PR.IDA
    WHERE MONTH(PR.Data_prenotazione) = 4
      AND YEAR(PR.Data_prenotazione) = YEAR(CURDATE())
      AND P.IDP = ?
    GROUP BY P.IDP, P.Denominazione;
    
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $idp);
}

if (!$stmt) {
    die("Errore nella preparazione della query: ");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Importo Totale Prenotazioni</title>
</head>
<body>
    <h1>Importo Totale delle Prenotazioni (Mese di Aprile)</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Palestra</th><th>Importo Totale</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Denominazione"] . "</td>";
            echo "<td>" . $row["Importo_Totale"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun record trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

