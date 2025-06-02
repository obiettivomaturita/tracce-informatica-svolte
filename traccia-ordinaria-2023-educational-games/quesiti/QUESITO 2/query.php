<?php
session_start();
$cf  = $_SESSION['cf_abbonato'];
$ida = $_POST['ida'];
$idp = $_POST['idp'];

require "db_connection.php";

$query = "
SELECT G.Giorno, G.Orario_inizio, A.Prezzo
FROM GIORNO_E_ORA G
JOIN ATTIVITA A ON G.IDA = A.IDA AND G.IDP = A.IDP
WHERE G.IDA = ? AND G.IDP = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $ida, $idp);
$stmt->execute();
$dt_attivita = $giorno . ' ' . $ora_inizio;
$stmt->bind_result($dt_attivita, $prezzo);
if (!$stmt->fetch()) {
    die("Attività non trovata.");
}
$stmt->close();



$inizio = new DateTime($dt_attivita);
$ora    = new DateTime();
$diff_h = ($inizio->getTimestamp() - $ora->getTimestamp()) / 3600;


$upd1 = "
UPDATE PRENOTARE
SET stato = 'cancellata', data_cancellazione = NOW()
WHERE CF = ? AND IDA = ? AND IDP = ? AND stato = 'attiva'
";
$stmt1 = $mysqli->prepare($upd1);
$stmt1->bind_param("sii", $cf, $ida, $idp);
$stmt1->execute();
$stmt1->close();


if ($diff_h >= 0 && $diff_h <= 48) {
    $upd2 = "
    UPDATE ABBONATO
    SET saldo_crediti = saldo_crediti + ?
    WHERE CF = ?
    ";
    $stmt2 = $mysqli->prepare($upd2);
    $stmt2->bind_param("ds", $prezzo, $cf);
    $stmt2->execute();
    $stmt2->close();

    echo "Disdetta OK: accreditati €" ;
} else {
    echo "Disdetta OK: nessun accredito (< 48 oe).";
}
?>