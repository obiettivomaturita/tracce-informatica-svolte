<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anno = $_POST["Anno"];
    $quantita = $_POST["Quantita"];
    $ida = $_POST["IDA"];
    
    if (empty($anno) || empty($quantita) || empty($ida)) {
        die("Tutti i campi sono obbligatori.");
    }
    if (!is_numeric($anno) || !is_numeric($ida)) {
        die("Anno e ID Apiario devono essere numerici.");
    }
    if (!is_numeric($quantita)) {
        die("La quantità deve essere numerica.");
    }
    
    $query = "INSERT INTO PRODUZIONE (Anno, Quantità, IDA) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    $stmt->bind_param("idi", $anno, $quantita, $ida);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Record di produzione inserito con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore nell'esecuzione: " . $stmt->error . "</p>";
    }
    $stmt->close();
    $connection->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Inserisci Produzione</title>
</head>
<body>
    <h1>Inserisci un Nuovo Record di Produzione</h1>
    <form action="insert.php" method="POST">
        <label for="Anno">Anno:</label>
        <input type="number" id="Anno" name="Anno" required><br><br>
        
        <label for="Quantita">Quantità:</label>
        <input type="number" step="0.01" id="Quantita" name="Quantita" required><br><br>
        
        <label for="IDA">ID Apiario (IDA):</label>
        <input type="number" id="IDA" name="IDA" required><br><br>
        
        <input type="submit" value="Inserisci">
    </form>
</body>
</html>




