<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idp = $_POST["IDP"];
    $ida = $_POST["IDA"];
    $giorno = $_POST["Giorno"];            
    $orario_inizio = $_POST["Orario_inizio"]; 
    $orario_fine = $_POST["Orario_fine"];     
    
    if (empty($idp) || empty($ida) || empty($giorno) || empty($orario_inizio) || empty($orario_fine)) {
        die("Tutti i campi sono obbligatori.");
    }
    if (!is_numeric($idp) || !is_numeric($ida) || !is_numeric($giorno)) {
        die("IDP, IDA e Giorno devono essere numerici.");
    }
    
    $query = "INSERT INTO GIORNO_E_ORA (IDP, IDA, Giorno, Orario_inizio, Orario_fine)
          VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("iiiss", $idp, $ida, $giorno, $orario_inizio, $orario_fine);
   
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Lezione inserita con successo!</p>";
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
    <title>Inserimento Lezione</title>
</head>
<body>
    <h1>Inserisci una Nuova Lezione</h1>
    <form action="insert.php" method="POST">
        <label for="IDP">ID Palestra:</label>
        <input type="number" id="IDP" name="IDP" required><br><br>
        
        <label for="IDA">ID Attività:</label>
        <input type="number" id="IDA" name="IDA" required><br><br>
        
        <label for="Giorno">Giorno (0 = lunedì, ..., 6 = domenica):</label>
        <input type="number" id="Giorno" name="Giorno" required min="0" max="6"><br><br>
        
        <label for="Orario_inizio">Orario Inizio:</label>
        <input type="time" id="Orario_inizio" name="Orario_inizio" required><br><br>
        
        <label for="Orario_fine">Orario Fine:</label>
        <input type="time" id="Orario_fine" name="Orario_fine" required><br><br>
        
        <input type="submit" value="Inserisci Lezione">
    </form>
</body>
</html>

