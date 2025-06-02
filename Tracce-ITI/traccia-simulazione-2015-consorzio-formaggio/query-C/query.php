<?php
require "db_connection.php";

$anno = $_POST["Anno"];

if (empty($anno)) {
    die("L'anno deve essere fornito.");
}

$query = "
SELECT C.*
FROM CASEIFICIO C
INNER JOIN PRODUZIONE P ON C.IDC = P.IDC
INNER JOIN FORMA F ON C.IDC = F.IDC
WHERE YEAR(P.Data) = ? AND F.Scelta = 1
GROUP BY C.IDC, C.Nome
HAVING SUM(P.FormeVendute) = (
    SELECT MAX(totale_venduto)
    FROM (
        SELECT SUM(P1.FormeVendute) AS totale_venduto
        FROM CASEIFICIO C1
        INNER JOIN PRODUZIONE P1 ON C1.IDC = P1.IDC
        INNER JOIN FORMA F1 ON C1.IDC = F1.IDC
        WHERE YEAR(P1.Data) = ? AND F1.Scelta = 1
        GROUP BY C1.IDC, C1.Nome
    ) AS T
);
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}
$stmt->bind_param("ii", $anno, $anno);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Caseificio con Maggior Vendita - Anno <?php echo $anno; ?></title>
</head>
<body>
    <h1>Caseificio con il maggior numero di forme vendute (Prima Scelta) nell'anno <?php echo $anno; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){;
        echo "<p>ID Caseificio: " . $row["IDC"] . "</p>";
        echo "<p> Nome: " . $row["Nome"] . "</p>";
        }
    } else {
        echo "<p>Nessun caseificio trovato per l'anno specificato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

