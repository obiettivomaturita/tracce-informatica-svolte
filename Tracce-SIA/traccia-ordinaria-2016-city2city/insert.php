<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cf = $_POST["CF"];
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $dataNascita = $_POST["DataNascita"];
    $stileVita = $_POST["StileVita"];
    $interesse = $_POST["Interesse"];
    $numeroFamiliari = $_POST["NumeroFamiliari"];

    $query = "INSERT INTO CLIENTE (CF, Nome, Cognome, Email, PasswordC, DataNascita, StileVita, Interesse, NumeroFamiliari)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("ssssssssi", $cf, $nome, $cognome, $email, $password, $dataNascita, $stileVita, $interesse, $numeroFamiliari);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Registrazione avvenuta con successo!</p>";
    } else {
        echo "<p style='color:red;'>Errore nella registrazione: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>
