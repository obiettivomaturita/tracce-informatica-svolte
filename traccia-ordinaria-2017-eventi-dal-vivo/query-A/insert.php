<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titolo = $_POST["Titolo"];
    $luogo = $_POST["Luogo"];
    $data = $_POST["Data"];
    $provincia = $_POST["Provincia"];
    $cf = $_POST["CF"];

    if (empty($titolo) || empty($luogo) || empty($data) || empty($provincia) || empty($cf)) {
        die("Tutti i campi sono obbligatori.");
    }

    $query = "INSERT INTO EVENTO (Titolo, Luogo, DataE, Provincia, CF) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssss", $titolo, $luogo, $data, $provincia, $cf);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Evento inserito con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

