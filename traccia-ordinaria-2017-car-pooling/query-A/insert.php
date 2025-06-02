<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targa = $_POST["Targa"];
    $marca = $_POST["Marca"];
    $modello = $_POST["Modello"];
    $anno = $_POST["Anno"];
    $posti = $_POST["NumeroPosti"];
    $documento = $_POST["NumeroDocumentoID"];

    $query = "INSERT INTO VEICOLO (Targa, Marca, Modello, Anno, NumeroPosti, NumeroDocumentoID)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssdis", $targa, $marca, $modello, $anno, $posti, $documento);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Veicolo inserito con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

