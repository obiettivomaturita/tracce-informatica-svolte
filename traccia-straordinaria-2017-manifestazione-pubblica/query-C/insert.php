<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST["Titolo"];
    $descrizione = $_POST["Descrizione"];
    $immagine = $_POST["Immagine"];
    $url = $_POST["URLApprofondimento"];
    $stato = $_POST["Stato"];
    $cf = $_POST["CF"];

    if (empty($titolo) || empty($descrizione) || empty($stato) || empty($cf)) {
        die("Tutti i campi obbligatori devono essere compilati.");
    }

    $query = "INSERT INTO CANDIDATURA (Titolo, Descrizione, Immagine, URLApprofondimento, StatoCandidatura, CF)
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("ssssss", $titolo, $descrizione, $immagine, $url, $stato, $cf);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Candidatura inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore durante l'inserimento: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

