<?php
require "db_connection.php";

$cf_studente = $_POST["cf_studente"];
$cf_docente = $_POST["cf_docente"];
$data = $_POST["data"];
$ora_inizio = $_POST["ora_inizio"];
$minuto_inizio = $_POST["minuto_inizio"];
$ora_fine = $_POST["ora_fine"];
$minuto_fine = $_POST["minuto_fine"];

$query = "INSERT INTO ASSENZA (DataASS, OraInizio, MinutoInizio, OraFine, MinutoFine, CF, CF_D) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $connection->prepare($query);
$stmt->bind_param("siiisss", $data, $ora_inizio, $minuto_inizio, $ora_fine, $minuto_fine, $cf_studente, $cf_docente);

if ($stmt->execute()) {
    echo "<p style='color: green;'>Assenza registrata con successo!</p>";
} else {
    echo "<p style='color: red;'>Errore nell'inserimento: " . $stmt->error . "</p>";
}

$stmt->close();
$connection->close();
?>

