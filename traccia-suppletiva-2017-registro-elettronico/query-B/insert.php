<?php
require "db_connection.php";

$cf = $_POST["CF"];
$nome = $_POST["Nome"];
$cognome = $_POST["Cognome"];
$data = $_POST["DataNascita"];
$assenze = $_POST["TotAssenze"];
$email = $_POST["Email"];
$password = $_POST["PasswordS"];
$idc = $_POST["IDC"];

$query = "INSERT INTO STUDENTE (CF, Nome, Cognome, DataNascita, TotAssenze, Email, PasswordS, IDC)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($query);
$stmt->bind_param("ssssissi", $cf, $nome, $cognome, $data, $assenze, $email, $password, $idc);

if ($stmt->execute()) {
    echo "Studente inserito con successo!";
} else {
    echo "Errore: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>

