<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataInizio = $_POST["DataInizio"];
    $dataFine = $_POST["DataFine"];
    $numeroInventario = $_POST["NumeroInventario"];
    $idc = $_POST["IDC"]; 
    $idu = $_POST["IDU"];

    if (empty($dataInizio) || empty($numeroInventario) || empty($idc) || empty($idu)) {
        die("I campi obbligatori (DataInizio, NumeroInventario, IDC, IDU) devono essere compilati.");
    }

    if (empty($dataFine)) {
        $query = "INSERT INTO PRESTITO (DataInizio, DataFine, NumeroInventario, IDC, IDU) VALUES (?, NULL, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            die("Errore nella preparazione della query: " . $connection->error);
        }

        $stmt->bind_param("siii", $dataInizio, $numeroInventario, $idc, $idu);
    } else {
        $query = "INSERT INTO PRESTITO (DataInizio, DataFine, NumeroInventario, IDC, IDU) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);

        if (!$stmt) {
            die("Errore nella preparazione della query: " . $connection->error);
        }

        $stmt->bind_param("ssiii", $dataInizio, $dataFine, $numeroInventario, $idc, $idu);
    }

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Prestito registrato con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>


