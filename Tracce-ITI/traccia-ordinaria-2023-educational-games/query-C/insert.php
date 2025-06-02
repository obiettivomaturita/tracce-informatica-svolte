<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $denominazione = $_POST["Denominazione"];
    $citta         = $_POST["Città"];
    $indirizzo     = $_POST["Indirizzo"];
    $latitudine    = $_POST["Latitudine"];
    $longitudine   = $_POST["Longitudine"];
    $username      = $_POST["Username"];
    $password      = $_POST["Password"];


    if (empty($denominazione) || empty($citta) || empty($indirizzo) || empty($username) || empty($password)) {
        die("Denominazione, Città, Indirizzo, Username e Password sono obbligatori.");
    }
    
    $query = "INSERT INTO PALESTRA (Denominazione, Città, Indirizzo, Latitudine, Longitudine, Username, Password)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    
    

    $stmt->bind_param("sssssss", $denominazione, $citta, $indirizzo, $latitudine, $longitudine, $username, $password);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Palestra inserita con successo!</p>";
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
    <title>Inserimento Palestra</title>
</head>
<body>
    <h1>Inserisci una Nuova Palestra</h1>
    <form action="insert.php" method="POST">
        <label for="Denominazione">Denominazione:</label>
        <input type="text" id="Denominazione" name="Denominazione" required><br><br>
        
        <label for="Città">Città:</label>
        <input type="text" id="Città" name="Città" required><br><br>
        
        <label for="Indirizzo">Indirizzo:</label>
        <input type="text" id="Indirizzo" name="Indirizzo" required><br><br>
        
        <label for="Latitudine">Latitudine:</label>
        <input type="text" id="Latitudine" name="Latitudine"><br><br>
        
        <label for="Longitudine">Longitudine:</label>
        <input type="text" id="Longitudine" name="Longitudine"><br><br>
        
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username" required><br><br>
        
        <label for="Password">Password:</label>
        <input type="password" id="Password" name="Password" required><br><br>
        
        <input type="submit" value="Inserisci Palestra">
    </form>
</body>
</html>

