<?php
require "db_connection.php";

$query = "
    SELECT U.Nome, U.Cognome, U.Nickname
    FROM (
        SELECT U.Nome, U.Cognome, U.Nickname, COUNT(*) AS EventiPubblicati
        FROM EVENTO E 
        INNER JOIN UTENTE U ON U.CF = E.CF
        GROUP BY U.CF, U.Nome, U.Cognome, U.Nickname
    ) AS TOTALE_EVENTI_PUBBLICATI
    WHERE EventiPubblicati = (
        SELECT MAX(EventiPubblicatiTmp)
        FROM (
            SELECT COUNT(*) AS EventiPubblicatiTmp
            FROM EVENTO E1 
            GROUP BY E1.CF
        ) AS PUBBLICAZIONI
    )
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Utente con Più Eventi</title>
</head>
<body>
    <h1>Utente che ha Registrato Più Eventi</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Nome</th><th>Cognome</th><th>Nickname</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Cognome"] . "</td>";
            echo "<td>" . $row["Nickname"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun risultato disponibile.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>


