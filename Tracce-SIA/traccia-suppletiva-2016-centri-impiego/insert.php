<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["Nome"];
    $indirizzo = $_POST["Indirizzo"];
    $ambito = $_POST["Ambito"];
    $email = $_POST["Email"];
    $password = $_POST["PasswordA"];

    if (empty($nome) || empty($indirizzo) || empty($ambito) || empty($email) || empty($password)) {
        die("Tutti i campi sono obbligatori.");
    }

    $query = "INSERT INTO AZIENDA (IDA, Nome, Indirizzo, Ambito, Email, PasswordA)
              VALUES (NULL, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("sssss", $nome, $indirizzo, $ambito, $email, $password);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Azienda registrata con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore durante l'inserimento: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>
