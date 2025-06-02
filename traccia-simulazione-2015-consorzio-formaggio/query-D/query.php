<?php
require "db_connection.php";

$data_inizio =$_POST["data_inizio"];
$data_fine   = $_POST["data_fine"];

if (empty($data_inizio) || empty($data_fine)) {
    die("Entrambe le date devono essere fornite.");
}

$query = "
    SELECT C.*
    FROM CASEIFICIO C 
    INNER JOIN FORMA F ON C.IDC=F.IDC
    WHERE P.DATA BETWEEN ? AND ?   
    AND F.Scelta=2
    GROUP BY C.IDC,C.Nome
    HAVING COUNT(*)<10;

";

$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}

$stmt->bind_param("ss", $data_inizio, $data_fine);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Produzione per Caseificio</title>
</head>
<body>
    <h1>Elenco caseifici con meno di 10 forme vendute di seconda scelta dal  <?php echo $data_inizio; ?> al <?php echo $data_fine; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr><th>Elenco Caseifici</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["IDC"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessun record trovato per l'intervallo indicato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

