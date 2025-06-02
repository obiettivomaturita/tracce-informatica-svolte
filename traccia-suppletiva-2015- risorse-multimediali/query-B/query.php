<?php
require "db_connection.php";

$centro = $_POST["centro"];

$query = "
SELECT DISTINCT C.Nome
FROM CATEGORIA C
INNER JOIN APPARTENERE A ON A.IDCA = C.IDCA
INNER JOIN RISORSA R ON R.NumeroInventario = A.NumeroInventario AND R.IDC = A.IDC
INNER JOIN CENTRO CE ON CE.IDC = R.IDC
WHERE CE.Nome = 'MediaCenter';

";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}
$stmt->bind_param("s", $centro);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Categorie per Centro</title>
</head>
<body>
    <h1>Categorie disponibili nel centro: <?php echo $centro; ?></h1>
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
        echo "<p>Nessuna categoria trovata per questo centro.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>