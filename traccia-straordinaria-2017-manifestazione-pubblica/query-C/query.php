<?php
require "db_connection.php";

$query = "
    SELECT CA.Nome, COUNT(DISTINCT E.CF) AS NumEspositori
    FROM CATEGORIA CA
    INNER JOIN APPARTENERE AP ON AP.IDCA = CA.IDCA
    INNER JOIN CANDIDATURA C ON AP.IDC = C.IDC
    INNER JOIN ESPOSITORE E ON C.CF = E.CF
    WHERE C.StatoCandidatura = 'Accettato'
    GROUP BY CA.IDCA, CA.Nome
    ORDER BY NumEspositori DESC
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Classifica Categorie</title>
</head>
<body>
    <h1>Classifica delle Categorie per Numero di Espositori</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Categoria</th><th>Numero Espositori</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["NumEspositori"] . "</td>";
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