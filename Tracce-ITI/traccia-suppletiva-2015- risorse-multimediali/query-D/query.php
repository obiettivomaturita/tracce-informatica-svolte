<?php
require "db_connection.php";

$query = "
    SELECT CA.Nome
    FROM (
        SELECT CA.Nome, COUNT(*) AS NumPrestiti
        FROM PRESTITO P
        INNER JOIN RISORSA R ON R.NumeroInventario = P.NumeroInventario AND R.IDC = P.IDC
        INNER JOIN APPARTENERE A ON A.NumeroInventario = R.NumeroInventario AND A.IDC = R.IDC
        INNER JOIN CATEGORIA CA ON CA.IDCA = A.IDCA
        GROUP BY CA.Nome
    ) AS PrestitiCategoria
    WHERE NumPrestiti = (
        SELECT MAX(NumP)
        FROM (
            SELECT COUNT(*) AS NumP
            FROM PRESTITO P
            INNER JOIN RISORSA R ON R.NumeroInventario = P.NumeroInventario AND R.IDC = P.IDC
            INNER JOIN APPARTENERE A ON A.NumeroInventario = R.NumeroInventario AND A.IDC = R.IDC
            INNER JOIN CATEGORIA CA ON CA.IDCA = A.IDCA
            GROUP BY CA.Nome
        ) AS MaxPrestiti
    )
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Categoria più utilizzata nei prestiti</title>
</head>
<body>
    <h1>Categoria più utilizzata nei prestiti</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Categoria</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["Nome"] . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuna categoria trovata.</p>";
    }

    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

