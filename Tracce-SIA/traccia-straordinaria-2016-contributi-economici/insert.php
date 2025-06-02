<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $protocollo = $_POST["Protocollo"];
    $idc = $_POST["IDC"];
    $cf = $_POST["CF"];
    $motivo = $_POST["Motivo"];
    $data = $_POST["Data"];
    $somma = $_POST["SommaMensile"];
    $stato = "In valutazione";

    if (empty($protocollo) || empty($idc) || empty($cf) || empty($motivo) || empty($data) || empty($somma)) {
        die("Tutti i campi sono obbligatori.");
    }

    $query1 = "INSERT INTO RICHIESTA (Protocollo, Stato, SommaMensile, Data, IDC) VALUES (?, ?, ?, ?, ?)";
    $stmt1 = $connection->prepare($query1);
    $stmt1->bind_param("ssdsi", $protocollo, $stato, $somma, $data, $idc);

    if (!$stmt1->execute()) {
        die("Errore nell'inserimento della richiesta: " . $stmt1->error);
    }

    $query2 = "INSERT INTO EFFETTUARE (Protocollo, CF, Motivo) VALUES (?, ?, ?)";
    $stmt2 = $connection->prepare($query2);
    $stmt2->bind_param("sss", $protocollo, $cf, $motivo);

    if ($stmt2->execute()) {
        echo "<p style='color: green;'>Richiesta inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore nell'inserimento del collegamento con il cittadino: " . $stmt2->error . "</p>";
    }

    $stmt1->close();
    $stmt2->close();
    $connection->close();
}
?>
