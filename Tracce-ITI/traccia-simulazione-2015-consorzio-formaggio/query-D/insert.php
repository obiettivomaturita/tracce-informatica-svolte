<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idc = $_POST["IDC"];
    $latteLavorato = $_POST["LatteLavorato"];
    $latteImpiegato = $_POST["LatteImpiegato"];
    $formeVendute = $_POST["FormeVendute"];
    $data = $_POST["Data"];
    
    if (empty($idc) || empty($latteLavorato) || empty($latteImpiegato) || empty($formeVendute) || empty($data)) {
        die("Tutti i campi sono obbligatori.");
    }
    if (!is_numeric($idc) || !is_numeric($latteLavorato) || !is_numeric($latteImpiegato) || !is_numeric($formeVendute)) {
        die("IDC, LatteLavorato, LatteImpiegato e FormeVendute devono essere numerici.");
    }
    
    $query = "INSERT INTO PRODUZIONE (IDC, LatteLavorato, LatteImpiegato, FormeVendute, Data)
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    
    $stmt->bind_param("iddis", $idc, $latteLavorato, $latteImpiegato, $formeVendute, $data);
    
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
        <label for="IDC">IDC (Caseificio):</label>
        <input type="number" id="IDC" name="IDC" required><br><br>
        
        <label for="LatteLavorato">Latte Lavorato:</label>
        <input type="number" step="0.01" id="LatteLavorato" name="LatteLavorato" required><br><br>
        
        <label for="LatteImpiegato">Latte Impiegato:</label>
        <input type="number" step="0.01" id="LatteImpiegato" name="LatteImpiegato" required><br><br>
        
        <label for="FormeVendute">Forme Vendute:</label>
        <input type="number" id="FormeVendute" name="FormeVendute" required><br><br>
        
        <label for="Data">Data:</label>
        <input type="date" id="Data" name="Data" required><br><br>
        
        <input type="submit" value="Inserisci Produzione">
    </form>
</body>
</html>

