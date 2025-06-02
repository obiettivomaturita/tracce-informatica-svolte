<?php
require "db_connection.php";

$citta = $_POST["citta"];

if ($citta === "Tutti" || empty($citta)) {
    $query = "
        SELECT Denominazione, Indirizzo
        FROM PALESTRA
        ORDER BY Denominazione
    ";
    $stmt = $connection->prepare($query);
} else {
    $query = "
        SELECT Denominazione, Indirizzo
        FROM PALESTRA
        WHERE Città = ?
        ORDER BY Denominazione
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $citta);
}

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
    <title>Elenco Palestre</title>
</head>
<body>
    <h1>Elenco delle Palestre <?php echo ($citta === "Tutti" || empty($citta)) ? "(tutte le città)" : "nella città di $citta"; ?></h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["Denominazione"] . "<br>";
            echo $row["Indirizzo"] . "<br><br>";
        }
    } else {
        echo "<p>Nessuna palestra trovata.</p>";
    }

    $stmt->close();
    $connection->close();
    ?>
</body>
</html>