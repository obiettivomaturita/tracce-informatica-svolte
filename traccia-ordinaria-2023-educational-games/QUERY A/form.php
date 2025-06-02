<?php
require "db_connection.php";

$query = "SELECT DISTINCT Città FROM PALESTRA";
$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Nessuna città disponibile.");
}

$citta = array();
while ($row = $result->fetch_assoc()) {
    $citta[] = $row['Città'];
}
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Elenco Città</title>
</head>
<body>
    <h1>Seleziona una Città</h1>
    <form action="query.php" method="POST">
        <label for="Città">Città:</label>
        <select id="Città" name="Città">
            <option value="Tutti">Tutti</option>
            <?php
            foreach ($citta as $city) {
                echo "<option>$city</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Cerca">
    </form>
</body>
</html>

