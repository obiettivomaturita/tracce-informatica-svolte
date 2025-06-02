<?php
require "db_connection.php";

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];

$query = "
SELECT S.Nome, S.Cognome, A.Data, A.OraInizio, A.MinutoInizio, A.OraFine, A.MinutoFine,
       GI.IDA AS GiornoIntero, EP.OraEntrata, EP.MinutoEntrata, UA.OraUscita, UA.MinutoUscita
FROM STUDENTE S
INNER JOIN ASSENZA A ON S.CF = A.CF
INNER JOIN GIORNO_INTERO GI ON GI.IDA = A.IDA
INNER JOIN ENTRATA_POSTICIPATA EP ON EP.IDA = A.IDA
INNER JOIN USCITA_ANTICIPATA UA ON UA.IDA = A.IDA
WHERE S.Nome = ? AND S.Cognome = ? AND (
    (YEAR(A.Data) = YEAR(CURDATE()) - 1 AND MONTH(A.Data) BETWEEN 9 AND 12)
    OR
    (YEAR(A.Data) = YEAR(CURDATE()) AND MONTH(A.Data) BETWEEN 1 AND 6)
)
ORDER BY A.Data;
";

$stmt = $connection->prepare($query);
$stmt->bind_param("ss", $nome, $cognome);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Assenze Studente</title>
</head>
<body>
    <h1>Assenze di <?php echo $nome . " " . $cognome; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'><thead><tr>
              <th>Data</th><th>Ora Inizio</th><th>Ora Fine</th>
              <th>Giorno Intero</th><th>Entrata Posticipata</th><th>Uscita Anticipata</th>
              </tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>{$row['Data']}</td>
                  <td>{$row['OraInizio']}:{$row['MinutoInizio']}</td>
                  <td>{$row['OraFine']}:{$row['MinutoFine']}</td>
                  <td>{$row['GiornoIntero']}</td>
                  <td>{$row['OraEntrata']}:{$row['MinutoEntrata']}</td>
                  <td>{$row['OraUscita']}:{$row['MinutoUscita']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuna assenza trovata.</p>";
    }

    $stmt->close();
    $connection->close();
    ?>
</body>
</html>