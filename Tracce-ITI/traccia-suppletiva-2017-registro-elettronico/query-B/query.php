<?php
require "db_connection.php";

$query = "
SELECT *
FROM STUDENTE S
WHERE NOT EXISTS (
    SELECT *
    FROM ASSENZA A WHERE A.CF = S.CF
);
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Studenti senza assenze</title>
</head>
<body>
    <h1>Elenco degli studenti che non hanno mai fatto assenze</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'><thead><tr>
              <th>Codice Fiscale</th><th>Nome</th><th>Cognome</th>
              </tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>{$row['CF']}</td>
                  <td>{$row['Nome']}</td>
                  <td>{$row['Cognome']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuno studente trovato senza assenze.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>