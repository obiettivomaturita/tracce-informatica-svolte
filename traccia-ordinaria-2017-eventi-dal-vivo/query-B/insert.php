<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cf = $_POST["CF"];
    $nome = $_POST["Nome"];
    $cognome = $_POST["Cognome"];
    $provincia = $_POST["Provincia"];
    $email = $_POST["Email"];
    $nickname = $_POST["Nickname"];
    $password = password_hash($_POST["PasswordU"], PASSWORD_DEFAULT);

    if (empty($cf) || empty($nome) || empty($cognome) || empty($provincia) || empty($email) || empty($nickname) || empty($password)) {
        die("Tutti i campi sono obbligatori.");
    }

    $query = "INSERT INTO UTENTE (CF, Nome, Cognome, Provincia, Email, Nickname, PasswordU) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("sssssss", $cf, $nome, $cognome, $provincia, $email, $nickname, $password);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Utente registrato con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

