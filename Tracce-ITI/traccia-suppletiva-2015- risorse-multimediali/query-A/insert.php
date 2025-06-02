<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idu = $_POST["IDU"];
    $inventario = $_POST["NumeroInventario"];
    $idc = $_POST["IDC"];
    $data = $_POST["DataPrenotazione"];

    if (empty($idu) || empty($inventario) || empty($idc) || empty($data)) {
        die("Tutti i campi sono obbligatori.");
    }

    if (!is_numeric($idu) || !is_numeric($inventario) || !is_numeric($idc)) {
        die("IDU, NumeroInventario e IDC devono essere numerici.");
    }

    $query = "INSERT INTO PRENOTARE (IDU, NumeroInventario, IDC, DataPrenotazione) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("iiis", $idu, $inventario, $idc, $data);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Prenotazione inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore nell'inserimento: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

