<?php
require "db_connection.php";

$categoria = $_POST["categoria"];

$query = "
    SELECT P.NumeroInventario, P.IDC, P.DataPrenotazione
    FROM PRENOTARE P
    INNER JOIN RISORSA R ON R.NumeroInventario = P.NumeroInventario AND R.IDC = P.IDC
    INNER JOIN APPARTENERE A ON A.NumeroInventario = R.NumeroInventario AND A.IDC = R.IDC
    INNER JOIN CATEGORIA C ON C.IDCA = A.IDCA
    WHERE C.Nome = ?
    ORDER BY R.Provincia
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}

$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Prenotazioni</title>
</head>
<body>
    <h1>Prenotazioni per categoria: <?php echo $categoria; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Numero Inventario</th><th>ID Centro</th><th>Data Prenotazione</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["NumeroInventario"] . "</td>";
            echo "<td>" . $row["IDC"] . "</td>";
            echo "<td>" . $row["DataPrenotazione"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuna prenotazione trovata per questa categoria.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>
