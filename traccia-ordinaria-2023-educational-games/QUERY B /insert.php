<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cf = $_POST["CF"];
    $idp = $_POST["IDP"];
    $ida = $_POST["IDA"];
    $data_prenotazione = $_POST["Data_prenotazione"];

    if (empty($cf) || empty($idp) || empty($ida) || empty($data_prenotazione)) {
        die("Tutti i campi sono obbligatori.");
    }
    if (!is_numeric($ida) ||!is_numeric($idp) ) {
        die("IDA e IDP devono essere numerici.");
    }
    
    $query = "INSERT INTO PRENOTARE (CF, IDP, IDA, Data_prenotazione) VALUES (?, ?,  ?, ?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: ");
    }
    
    $stmt->bind_param("siis", $cf, $idp, $ida, $data_prenotazione);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Prenotazione inserita con successo!</p>";
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
    <title>Inserisci Prenotazione</title>
</head>
<body>
    <h1>Inserisci una Nuova Prenotazione</h1>
    <form action="insert.php" method="POST">
        <label for="CF">Codice Fiscale Abbonato:</label>
        <input type="text" id="CF" name="CF" required><br><br>
        
        <label for="IDP">ID Palestra:</label>
        <input type="number" id="IDP" name="IDP" required><br><br>

        <label for="IDA">ID Attività:</label>
        <input type="number" id="IDA" name="IDA" required><br><br>
        
        <label for="Data_prenotazione">Data Prenotazione (YYYY-MM-DD):</label>
        <input type="date" id="Data_prenotazione" name="Data_prenotazione" required><br><br>
        
        <input type="submit" value="Inserisci Prenotazione">
    </form>
</body>
</html>

