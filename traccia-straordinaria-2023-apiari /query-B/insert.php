<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n_arnie   = $_POST["N_Arnie"];
    $localita  = $_POST["Localita"];
    $comune    = $_POST["Comune"];
    $provincia = $_POST["Provincia"];
    $regione   = $_POST["Regione"];
    $idm       = $_POST["IDM"]; // IDM deve corrispondere a un record nella tabella MIELE

    if (empty($n_arnie) || !is_numeric($n_arnie)) {
        die("Il numero di arnie deve essere un numero.");
    }
    if (empty($localita) || empty($regione) || empty($idm)) {
        die("Località, Regione e IDM sono obbligatori.");
    }

    $query = "INSERT INTO APIARIO (N_Arnie, Localita, Comune, Provincia, Regione, IDM)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    
    $stmt->bind_param("issssi", $n_arnie, $localita, $comune, $provincia, $regione, $idm);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Apiario inserito con successo!</p>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Apiario</title>
</head>
<body>
    <h1>Inserisci un Nuovo Apiario</h1>
    <form action="insert.php" method="POST">
        <label for="N_Arnie">Numero di Arnie:</label>
        <input type="number" id="N_Arnie" name="N_Arnie" required><br><br>
        
        <label for="Localita">Località:</label>
        <input type="text" id="Localita" name="Localita" required><br><br>
        
        <label for="Comune">Comune:</label>
        <input type="text" id="Comune" name="Comune"><br><br>
        
        <label for="Provincia">Provincia:</label>
        <input type="text" id="Provincia" name="Provincia"><br><br>
        
        <label for="Regione">Regione:</label>
        <input type="text" id="Regione" name="Regione" required><br><br>
        
        <label for="IDM">IDM (ID del Miele):</label>
        <input type="number" id="IDM" name="IDM" required><br><br>
        
        <input type="submit" value="Inserisci Apiario">
    </form>
</body>
</html>
