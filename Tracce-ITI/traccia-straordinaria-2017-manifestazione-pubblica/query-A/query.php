<?php
require "db_connection.php";

$query = "
    SELECT E.Nome, E.Cognome, A.Nome AS Area
    FROM ESPOSITORE E
    INNER JOIN AREA A ON E.IDA = A.IDA
    ORDER BY E.Cognome, E.Nome
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Espositori per Area</title>
</head>
<body>
    <h1>Elenco Espositori con Area Assegnata</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Nome</th><th>Cognome</th><th>Area</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Cognome"] . "</td>";
            echo "<td>" . $row["Area"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun espositore trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>