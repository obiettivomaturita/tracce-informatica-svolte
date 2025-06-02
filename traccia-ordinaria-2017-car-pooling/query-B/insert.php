<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $doc = $_POST["NumeroDocumentoID"];
    $idv = $_POST["IDV"];
    $stato = $_POST["Stato"];

    $query = "INSERT INTO PRENOTARE (NumeroDocumentoID, IDV, Stato)
              VALUES (?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sis", $doc, $idv, $stato);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Prenotazione inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

