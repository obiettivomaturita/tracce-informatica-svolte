<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cf = $_POST["CF"];
    $ide = $_POST["IDE"];
    $data_commento = $_POST["DataCommento"];
    $voto = $_POST["Voto"];
    $commento = $_POST["Commento"];

    if (empty($cf) || empty($ide) || empty($data_commento) || empty($voto)) {
        die("Tutti i campi obbligatori devono essere compilati.");
    }

    $query = "INSERT INTO COMMENTARE (CF, IDE, DataCommento, Voto, Commento) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sisss", $cf, $ide, $data_commento, $voto, $commento);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Commento inserito con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

