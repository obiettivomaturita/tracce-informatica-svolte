<?php
require "db_connection.php";

$idv = $_POST["IDV"];
$doc = $_POST["NumeroDocumentoID"];

$query = "
    SELECT U.Email, V.CittaPartenza, V.CittaDestinazione, V.DataPartenza, V.OraPartenza,
           UA.Nome AS NomeAutista, UA.Cognome AS CognomeAutista,
           VE.Marca, VE.Modello, VE.Targa
    FROM PRENOTARE P
    INNER JOIN UTENTE U ON U.NumeroDocumentoID = P.NumeroDocumentoID
    INNER JOIN VIAGGIO V ON V.IDV = P.IDV
    INNER JOIN AUTISTA A ON A.NumeroDocumentoID = V.NumeroDocumentoID
    INNER JOIN UTENTE UA ON UA.NumeroDocumentoID = A.NumeroDocumentoID
    INNER JOIN VEICOLO VE ON VE.NumeroDocumentoID = A.NumeroDocumentoID
    WHERE P.IDV = ? AND P.NumeroDocumentoID = ? AND P.Stato = 'Accettata'
";

$stmt = $connection->prepare($query);
$stmt->bind_param("is", $idv, $doc);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Promemoria Viaggio</title>
</head>
<body>
    <h1>Promemoria Prenotazione</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'><thead><tr>
              <th>Email</th><th>Partenza</th><th>Destinazione</th><th>Data</th><th>Ora</th>
              <th>Autista</th><th>Auto</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>{$row['Email']}</td>
                  <td>{$row['CittaPartenza']}</td>
                  <td>{$row['CittaDestinazione']}</td>
                  <td>{$row['DataPartenza']}</td>
                  <td>{$row['OraPartenza']}</td>
                  <td>{$row['NomeAutista']} {$row['CognomeAutista']}</td>
                  <td>{$row['Marca']} {$row['Modello']} ({$row['Targa']})</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun promemoria trovato o prenotazione non accettata.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>