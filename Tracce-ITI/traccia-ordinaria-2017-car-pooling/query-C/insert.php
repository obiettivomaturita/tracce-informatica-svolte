<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cf = $_POST["NumeroDocumentoID"];
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $recapito = $_POST["Recapito"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["PasswordU"], PASSWORD_DEFAULT);
    $giudizio = $_POST["Giudizio"];
    $voto = $_POST["VotoMedio"];

    $query = "INSERT INTO UTENTE (NumeroDocumentoID, Nome, Cognome, Recapito, Email, PasswordU, Giudizio, VotoMedio)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssssssd", $cf, $nome, $cognome, $recapito, $email, $password, $giudizio, $voto);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Utente inserito con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

