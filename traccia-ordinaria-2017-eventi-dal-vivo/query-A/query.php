<?php
require "db_connection.php";

$query = "
    SELECT E.Titolo, E.Luogo
    FROM EVENTO E
    WHERE E.DataE < CURDATE()
    ORDER BY E.Provincia
";

$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Eventi Già Svolti</title>
</head>
<body>
    <h1>Eventi Già Svolti</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Titolo</th><th>Luogo</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Titolo"] . "</td>";
            echo "<td>" . $row["Luogo"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun evento svolto trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>
