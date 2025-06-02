<?php
require "db_connection.php";

$idc = $_POST["IDC"];
$indirizzo = $_POST["Indirizzo"];
$tipologia = $_POST["Tipologia"];

$query = "INSERT INTO CLASSE (IDC, Indirizzo, Tipologia) VALUES (?, ?, ?)";

$stmt = $connection->prepare($query);
$stmt->bind_param("sss", $idc, $indirizzo, $tipologia);

if ($stmt->execute()) {
    echo "<p style='color: green;'>Classe inserita con successo!</p>";
} else {
    echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
}

$stmt->close();
$connection->close();
?>

