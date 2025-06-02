<?php
require 'db_connection.php';

$idm = $_POST['IDM'];
$taglia = $_POST['Taglia'];

$query = "
    SELECT PV.Città, PV.Indirizzo, COUNT(*) AS Quantità
    FROM CAPO C
    INNER JOIN PUNTO_VENDITA PV ON PV.IDP = C.IDP
    WHERE C.IDM = ? AND C.Taglia = ? AND C.Disponibile = TRUE
    GROUP BY PV.IDP, PV.Città, PV.Indirizzo
    ORDER BY PV.Città
";

$stmt = $connection->prepare($query);
$stmt->bind_param("is", $idm, $taglia);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Disponibilità</title>
</head>
<body>
    <h1>Disponibilità capi per Modello <?= $idm ?> taglia <?= $taglia ?></h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'><thead><tr><th>Città</th><th>Indirizzo</th><th>Quantità</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Città"] . "</td>";
            echo "<td>" . $row["Indirizzo"] . "</td>";
            echo "<td>" . $row["Quantità"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun capo disponibile per questo modello e taglia.</p>";
    }

    $stmt->close();
    $connection->close();
    ?>
</body>
</html>
