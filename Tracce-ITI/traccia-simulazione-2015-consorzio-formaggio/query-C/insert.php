<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    
    if (empty($nome)) {
        die("Il nome del caseificio è obbligatorio.");
    }
    
    $query = "INSERT INTO CASEIFICIO (Nome) VALUES (?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    
    $stmt->bind_param("s", $nome);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Caseificio inserito con successo!</p>";
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
    <title>Inserisci Caseificio</title>
</head>
<body>
    <h1>Inserisci un Nuovo Caseificio</h1>
    <form action="insert.php" method="POST">
        <label for="Nome">Nome del Caseificio:</label>
        <input type="text" id="Nome" name="Nome" required>
        <br><br>
        <input type="submit" value="Inserisci">
    </form>
</body>
</html>

