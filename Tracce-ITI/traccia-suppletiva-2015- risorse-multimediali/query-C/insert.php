<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroinventario = $_POST["NumeroInventario"];
    $nome = $_POST["Nome"];
    $tipologia = $_POST["Tipologia"];
    $disponibile = $_POST["Disponibile"];
    $provincia = $_POST["Provincia"];
    $idc = $_POST["IDC"];

    if (empty($numeroinventario) || empty($nome) || empty($tipologia) || $disponibile === "" || empty($provincia) || empty($idc)) {
        die("Tutti i campi sono obbligatori.");
    }

    $query = "INSERT INTO RISORSA (NumeroInventario, IDC, Nome, Tipologia, Disponibile, Provincia)
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("iissis", $numeroinventario, $idc, $nome, $tipologia, $disponibile, $provincia);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Risorsa inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

