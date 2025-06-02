<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $istituto = $_POST["Istituto_formazione"];
    $email = $_POST["Email"];
    $password = $_POST["PasswordS"];

    if (empty($nome) || empty($cognome) || empty($istituto) || empty($email) || empty($password)) {
        die("Tutti i campi sono obbligatori.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO STUDENTE (Nome, Cognome, Istituto_formazione, Email, PasswordS) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("sssss", $nome, $cognome, $istituto, $email, $password_hash);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Registrazione completata con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore durante l'inserimento: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

