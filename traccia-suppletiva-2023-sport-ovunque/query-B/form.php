<?php
require "db_connection.php";

$query = "SELECT IDP FROM PALESTRA";
$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Nessuna palestra disponibile.");
}

$palestraList = array();
while ($row = $result->fetch_assoc()) {
    $palestraList[] = $row;
}
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Seleziona Palestra</title>
</head>
<body>
    <h1>Seleziona una Palestra</h1>
    <form action="query.php" method="POST">
        <label for="IDP">Palestra:</label>
        <select id="IDP" name="IDP">
            <option value="Tutti">Tutti</option>
            <?php 
            foreach ($palestraList as $p) {
                echo "<option value=\"" . $p["IDP"] . "\">" . $p["IDP"] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Cerca">
    </form>
</body>
</html>

