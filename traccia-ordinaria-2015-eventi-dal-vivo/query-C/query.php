<?php
require "db_connection.php";

$query = "
    SELECT E.Titolo, CA.Nome, AVG(C.Voto) AS VotoMedio
    FROM EVENTO E
    INNER JOIN COMMENTARE C ON C.IDE = E.IDE
    INNER JOIN APPARTENERE AP ON AP.IDE = E.IDE
    INNER JOIN CATEGORIA CA ON AP.IDCA = CA.IDCA
    GROUP BY E.IDE, E.Titolo, CA.Nome
    ORDER BY CA.Nome, E.Titolo
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Voto Medio per Evento e Categoria</title>
</head>
<body>
    <h1>Voto Medio degli Eventi per Categoria</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Titolo</th><th>Categoria</th><th>Voto Medio</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Titolo"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . round($row["VotoMedio"], 2) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun dato disponibile.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>