<?php
require "db_connection.php";

$query = "
    SELECT R.Nome, R.Tipologia
    FROM PRESTITO PR
    INNER JOIN RISORSA R ON R.NumeroInventario = PR.NumeroInventario AND R.IDC = PR.IDC
    INNER JOIN CATEGORIA CA ON CA.IDCA = R.IDCA
    INNER JOIN CENTRO C ON C.IDC = R.IDC
    WHERE PR.DataFine IS NULL AND DATEDIFF(CURDATE(), PR.DataInizio) > 180  
    ORDER BY C.Nome, CA.Nome;
    ";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risorse in prestito da oltre 180 giorni</title>
</head>
<body>
    <h1>Risorse in prestito da oltre 180 giorni</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Centro</th><th>Categoria</th><th>Nome Risorsa</th><th>Tipologia</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Tipologia"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuna risorsa trovata in prestito da oltre 180 giorni.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>