<?php
require "db_connection.php";

$query = "SELECT DISTINCT Regione FROM Apiari";
$stmt = $connection->prepare($query);
if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}
$stmt->execute();
$result = $stmt->get_result(); 

if ($result->num_rows == 0) {
    die("Nessuna regione disponibile.");
}

$regioni = [];
while ($row = $result->fetch_assoc()) {
    $regioni[] = $row['Regione'];
}
$stmt->close();
$connection->close();

?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elenco regioni</title>
    </head>
    <body>
        <h1>Elenco regioni</h1>
        <form action="form.php" method="POST">
            <select id="Regione" name="Regione">
                <option value="Tutti">Tutti</option>
                <?php foreach ($regioni as $regione){ 
                    echo "<option>$regione</option>";
                    }
                    ?>
            </select>
            <br><br>
            <input type="submit" value="Cerca regione">
        </form>
    </body>
</html>





