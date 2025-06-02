<?php
require "db_connection.php";

$query = "
    SELECT C.Nome, C.Tipologia, C.DataInizio, C.DataFine, C.Costo, V.Modello AS Velivolo
    FROM CORSO C
    INNER JOIN VELIVOLO V ON C.IDV = V.IDV
    WHERE C.DataInizio > CURDATE()
";

$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Corsi Disponibili</title>
</head>
<body>
    <h1>Elenco dei corsi disponibili</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>";
            echo "<strong>Nome corso:</strong> " . $row["Nome"] . "<br>";
            echo "<strong>Tipologia:</strong> " . $row["Tipologia"] . "<br>";
            echo "<strong>Data inizio:</strong> " . $row["DataInizio"] . "<br>";
            echo "<strong>Data fine:</strong> " . $row["DataFine"] . "<br>";
            echo "<strong>Costo:</strong> €" . $row["Costo"] . "<br>";
            echo "<strong>Velivolo:</strong> " . $row["Velivolo"] . "<br>";
            echo "</p><hr>";
        }
    } else {
        echo "<p>Nessun corso disponibile al momento.</p>";
    }

    $connection->close();
    ?>
</body>
</html>
