<?php
require "db_connection.php";

$query = "
    SELECT U.Nome, U.Cognome
    FROM UTENTE U 
    WHERE NOT EXISTS (
        SELECT *
        FROM COMMENTARE C
        WHERE U.CF = C.CF 
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
    <title>Utenti senza Commenti</title>
</head>
<body>
    <h1>Utenti che non hanno mai inserito un commento</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Nome</th><th>Cognome</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Cognome"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun utente trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>