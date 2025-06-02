<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Inserisci Recensione</title>
</head>
<body>
    <h1>Inserisci una Recensione</h1>
    <form action="recensire_insert.php" method="POST">
        <label for="idv">ID Videogioco:</label>
        <input type="number" id="idv" name="idv" required><br><br>

        <label for="ids">ID Studente:</label>
        <input type="number" id="ids" name="ids" required><br><br>

        <label for="punteggio">Punteggio (1-5):</label>
        <input type="number" id="punteggio" name="punteggio" min="1" max="5" required><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" maxlength="160" rows="4" cols="50" required></textarea><br><br>

        <label for="data">Data Recensione:</label>
        <input type="date" id="data" name="data" required><br><br>

        <input type="submit" value="Invia Recensione">
    </form>
</body>
</html>

<?php
require "db_connection.php";

$query = "
    INSERT INTO RECENSIRE (IDV, IDS, Punteggio, Descrizione,DataR)
    VALUES (?, ?, ?, ?,?)
";

$stmt = $connection->prepare($query);
$stmt->bind_param("iiiss", $_POST['idv'], $_POST['ids'], $_POST['punteggio'], $_POST['descrizione'],$_POST['data']);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Inserimento Recensione</title>
</head>
<body>
    <h1>Inserimento Recensione</h1>
    <?php
    if ($stmt->affected_rows > 0) {
        echo "<p>Recensione inserita correttamente.</p>";
    } else {
        echo "<p>Errore nell'inserimento della recensione.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>